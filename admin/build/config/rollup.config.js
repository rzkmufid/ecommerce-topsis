"use strict";

const { babel } = require("@rollup/plugin-babel");

const pkg = require("../../package");
const year = new Date().getFullYear();
const banner = `/*!
 *  v${pkg.version} (${pkg.homepage})
 * Copyright 2014-${year} ${pkg.author}
 * Licensed under MIT (https://github.com/ColorlibHQ//blob/master/LICENSE)
 */`;

module.exports = {
  input: "build/js/.js",
  output: {
    banner,
    file: "dist/js/.js",
    format: "umd",
    globals: {
      jquery: "jQuery",
    },
    name: "",
  },
  external: ["jquery"],
  plugins: [
    babel({
      exclude: "node_modules/**",
      // Include the helpers in the bundle, at most one copy of each
      babelHelpers: "bundled",
    }),
  ],
};
