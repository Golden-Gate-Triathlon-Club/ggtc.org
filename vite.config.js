import { defineConfig } from 'vite';
import includeHtml from 'vite-plugin-include-html';
import prettier from 'vite-plugin-prettier';

export default defineConfig({
  plugins: [
    includeHtml({
      root: '.',
    }),
    prettier({
      configFile: './prettier.config.js', // Optional: specify config file
    }),
  ],
});