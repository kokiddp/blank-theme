const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
    entry: {
        App: "./js/scripts.js"
    },
    output: {
        path: path.resolve(__dirname, "./js"),
        filename: "scripts-bundled.js"
    },
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /node_modules/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env']
                }
            }
        }]
    },
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin({
            terserOptions: {
                output: {
                    comments: /^\**!|@preserve|@license|@cc_on/i,
                },
            },
            extractComments: false
        })],
    },
    mode: 'development'
}