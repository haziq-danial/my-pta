module.exports = {
    devServer: {
      proxy: {
          "/api/*": {
              target: 'http://localhost/PTA',
              changeOrigin: true,
              secure: false
          }
      }
    }
}