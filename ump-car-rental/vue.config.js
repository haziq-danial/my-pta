module.exports = {
    devServer: {
      proxy: {
          "/api/*": {
              target: 'http://localhost/haziq%20projects/PTA',
              changeOrigin: true,
              secure: false
          }
      }
    }
}