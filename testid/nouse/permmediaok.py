#filename:media.py
from basic import Basic
import urllib2
import json
import poster.encode
from poster.streaminghttp import register_openers

class Material(object):
      def __init__(self):
          register_openers()
      #upload images
      def add_news(self,accessToken,news,mediaType):
          #openFile = open(filePath,"rb")
          #param = {'media':openFile}
          #postData,postHeaders = poster.encode.multipart_encode(param)
          postUrl = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=%s&type=%s" % (accessToken,mediaType)
          #postUrl = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=%s" % accessToken
          #request = urllib2.Request(postUrl,postData,postHeaders)
          urlResp = urllib2.urlopen(postUrl,news)
          print urlResp.read()

if __name__ == '__main__':
     myMaterial = Material()
     accessToken = Basic().get_access_token()
     print "accesstoken is :%s" % accessToken
     news=(
     {
       "media":
       [
          {
          "filename":"@material/timg.jpg" ,
          "filelength":7525,
          "content-type":"image/jpg",
          }
        ]
     })
     #"filename":"@/var/www/html/weixi/testid/material/glass.jpg" ,
     #news=json.dumps(news,ensure_ascii=False)
     #filePath="/var/www/html/weixin/testid/material/glass.jpg"
     mediaType = "image"
     news=json.dumps(news,ensure_ascii=False)
     myMaterial.add_news(accessToken,news,mediaType)
