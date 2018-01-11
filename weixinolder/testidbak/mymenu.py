# -*- coding: utf-8 -*-
# filename: menu.py
import urllib
from basic import Basic
#from basic import Basic
#accessToken="fZ_RT9-hbXkvTNtJs1vIJ_wLXYYxWGyd18FFeQGAKqaoWA9TpVg2Q6glxxrFW5ZJJ8e3Eaz89T8ZZPe0G4naOApGaWsOkYHoP9OgIIbAPpFhAMTHob0IwSutkJdjpYtsBAEhAHARQU"
#accessToken="CcKsAaUlWRQBcHIEmr0iH7nYBDoVSzMloCOo-eWio_YF1l2AtAFuZSs-2PkOAUp4VZ4yUknYroPgKw-SVb0TWr9_Q8sk6SocpZoOLDURoh-zWf7q5Ima_dfHpaHpGe4aREGgACAXKM"
accessToken=Basic().get_access_token()
#accessToken="dBGQuLrHpAR4_r49uGZLobFPdNBoAWjWbwQvmVIFFoEofedFkeoSdB96eeFs5SNDa9EIpp9zvaN6P4NVY6kJTie9OFJSfa4k8a_j3E8BWiDwmUsBW6EgaKEe-azraylwPVKaADAGMB"
#accessToken="LwpbPINUbjt-EBAZykI62QVbmKk1q2O0vLfZ06ARThuaN4v8lXCltpuXFH-AWq-_kkyOTEVi0cYsM_mo2TV4bRe6xg-ZuD1UqpGz4HnrQZCnwleMgbITyaFirsBkgwbeKXFbACAUHP"
#accessToken="YzWFBNxDkgGT7SIfM8lSfZIYkKZDsnVqrNDkki4qzoLrhz4una6BbvBYP3e_oQpGEGJ7SOXLc82jqsRCI2hmhtu3KCFar4dlgDUbSlqAvCH2Vh5jhmVsIYG9rBflcwFyPIWjAJAWPD"
class Menu(object):
    def __init__(self):
        pass
    def create(self, postData, accessToken):
        postUrl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s" % accessToken
        print "accesstoken is :%s" % accessToken
        if isinstance(postData, unicode):
            postData = postData.encode('utf-8')
        urlResp = urllib.urlopen(url=postUrl, data=postData)
        print urlResp.read()

 #   def query(self, accessToken):
 #       postUrl = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=%s" % accessToken
 #       urlResp = urllib.urlopen(url=postUrl)
 #       print urlResp.read()

 #   def delete(self, accessToken):
 #       postUrl = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=%s" % accessToken
 #       urlResp = urllib.urlopen(url=postUrl)
 #       print urlResp.read()
        
    #获取自定义菜单配置接口
 #   def get_current_selfmenu_info(self, accessToken):
 #       postUrl = "https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=%s" % accessToken
 #       urlResp = urllib.urlopen(url=postUrl)
 #       print urlResp.read()

if __name__ == '__main__':
    myMenu = Menu()
    postJson = """
    {
        "button":
        [
            {
                "type": "click",
                "name": "会议助手",
                "key":  "mpGuide"
            },
            {
                "name": "会议管理",
                "sub_button":
                [
                    {
                        "type": "view",
                        "name": "更新公告",
                        "url":"http://www.sohu.com"
                    },
                    {
                        "type": "view",
                        "name": "接口权限说明",
                        "url": "http://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1418702138&token=&lang=zh_CN"
                    },
                    {
                        "type": "view",
                        "name": "返回测试",
                        "url": "http://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1433747234&token=&lang=zh_CN"
                    }
                ]
            },
            {
                "type": "media_id",
                "name": "测试8",
                "media_id":"3MMgNhMRRmRQKDg420_-BlgdIqcehxadrlzJyrw8BVA"
            }
          ]
    }
    """
                       # "url": "http://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1418702138&token=&lang=zh_CN"
  #  accessToken = Basic().get_access_token()
         #   {
               # "media_id": "3MMgNhMRRmRQKDg420_-Bk1_SdK_gfM8-vEMD2rAynk"
               # "media_id": "3MMgNhMRRmRQKDg420_-Bms2dT8DTus65_9ZGYS28qk"
         #       "type": "media_id",
         #       "name": "旅行",
         #       "media_id":"mX6kfnwMAhd8Q3bWpG-31LsvSY8KEdhVNyUytOthZyu6ban0ldCfGytChNa-ezhs"
         #   }
    #myMenu.delete(accessToken)
      #"media_id": "z2zOokJvlzCXXNhSjF46gdx6rSghwX2xOD5GUV9nbX4"
          #  {
          #      "type": "media_id",
          #      "name": "旅行",
                   #"media_id": "3MMgNhMRRmRQKDg420_-BjekSRBxtWiV-3rZxpvMlDs"
               #  "media_id":"RbhuU_Z4ppEv6gZmRlV_DsnTobG9Yt3sJSFQ4OJ8yhjpW2watHzd4vukRMyhoYPi" 
          #       "media_id":"RbhuU_Z4ppEv6gZmRlV_DsnTobG9Yt3sJSFQ4OJ8yhjpW2watHzd4vukRMyhoYPi" 
          #  }
          #  {
          #      "type": "media_id",
          #      "name": "旅行",
          #      "media_id": "S67E9IKD4Uny27d9oyhO7u4uM0bFmfr4OtK7Yh08gjnv49kk_Q46KWddOyU-eSgF"
          #  }
    myMenu.create(postJson, accessToken)
