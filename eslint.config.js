import js from '@eslint/js';
import prettier from 'eslint-config-prettier/flat';
import globals from 'globals';

export default [
    {
        ignores: ['vendor', 'node_modules', 'public', 'storage', 'bootstrap'],
    },
    js.configs.recommended,
    {
        languageOptions: {
            ecmaVersion: 'latest',
            sourceType: 'module',
            globals: globals.browser,
        },
    },
    prettier,
];
