<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffMember;
use App\Services\ImageResizer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StaffMemberController extends Controller
{
    public function index()
    {
        $groups = collect(StaffMember::GROUPS)->map(fn ($label, $group) => [
            'label' => $label,
            'members' => StaffMember::inGroup($group)->get(),
        ]);

        return view('admin.staff.index', compact('groups'));
    }

    public function create(Request $request)
    {
        $member = new StaffMember(['group' => $request->query('gruppo', 'direttivo')]);

        return view('admin.staff.form', compact('member'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        // In fondo al suo gruppo
        $data['position'] = (StaffMember::where('group', $data['group'])->max('position') ?? -1) + 1;

        if ($request->hasFile('photo')) {
            $data['photo_path'] = ImageResizer::store($request->file('photo'), 'staff', 400);
        }

        StaffMember::create($data);

        return redirect()->route('admin.staff.index')->with('success', 'Persona aggiunta allo staff.');
    }

    public function edit(StaffMember $staff)
    {
        return view('admin.staff.form', ['member' => $staff]);
    }

    public function update(Request $request, StaffMember $staff)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo') || $request->boolean('remove_photo')) {
            if ($staff->photo_path) {
                Storage::disk('public')->delete($staff->photo_path);
            }
            $data['photo_path'] = $request->hasFile('photo')
                ? ImageResizer::store($request->file('photo'), 'staff', 400)
                : null;
        }

        if ($data['group'] !== $staff->group) {
            $data['position'] = (StaffMember::where('group', $data['group'])->max('position') ?? -1) + 1;
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')->with('success', 'Dati aggiornati.');
    }

    public function destroy(StaffMember $staff)
    {
        if ($staff->photo_path) {
            Storage::disk('public')->delete($staff->photo_path);
        }

        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Persona rimossa dallo staff.');
    }

    // Sposta su o giù di una posizione all'interno del gruppo
    public function move(Request $request, StaffMember $staff)
    {
        $direction = $request->validate(['direction' => 'required|in:up,down'])['direction'];

        $members = StaffMember::inGroup($staff->group)->get()->values();
        $index = $members->search(fn ($member) => $member->is($staff));
        $swapWith = $direction === 'up' ? $index - 1 : $index + 1;

        if ($swapWith >= 0 && $swapWith < $members->count()) {
            $reordered = $members->all();
            [$reordered[$index], $reordered[$swapWith]] = [$reordered[$swapWith], $reordered[$index]];

            foreach ($reordered as $position => $member) {
                $member->updateQuietly(['position' => $position]);
            }
        }

        return redirect()->route('admin.staff.index');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'group' => ['required', Rule::in(array_keys(StaffMember::GROUPS))],
            'role' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
        ]);

        // La foto viene gestita a parte (ridimensionamento e percorso)
        return Arr::except($data, 'photo');
    }
}
