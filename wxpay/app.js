//app.js
App({
  onLaunch: function () {
    console.log('App Launch')
    //调用API从本地缓存中获取数据
    var logs = wx.getStorageSync('logs') || []
    logs.unshift(Date.now())
    wx.setStorageSync('logs', logs)
  },
  getUserInfo:function(cb){
    var that = this
    if (that.globalData.userInfo){
      typeof cb == "function" && cb(that.globalData.userInfo)
    }else{
      //调用登录接口
      wx.login({
        success: function (res) {
          console.log(res)
          if (res.code) {
            //存在code
            wx.request({
              url: that.globalData.serverUrl,
              data: {code: res.code},
              method: 'POST',
              header: {
                "content-type": "application/x-www-form-urlencoded"
              },
              success: function (res) {
                console.log(res);
                that.globalData.openid = res.data.data.openid
              },
              fail: function () {
                console.log('服务器请求失败!')
              },
            })
          } else {
            console.log('获取用户信息失败!' + res.errMsg)
          }
        }
      })
    }
  },
  onShow: function () {
    console.log('App Show')
  },
  onHide: function () {
    console.log('App Hide')
  },
  globalData:{
    userInfo:null,
    openid:null,
    serverUrl:'http://118.184.217.16:8888'
  }
})