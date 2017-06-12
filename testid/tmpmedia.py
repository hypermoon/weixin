#filename:media.py
from basic import Basic
import urllib2
import poster.encode
from poster.streaminghttp import register_openers

class Media(object):
      def __init__(self):
          register_openers()
      #upload images
      def upload(self, accessToken,filePath,mediaType):
          openFile = open(filePath,"rb")
          param = {'media':openFile}
          postData,postHeaders = poster.encode.multipart_encode(param)

          postUrl = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=%s&type=%s" % (accessToken,mediaType)
          #postUrl = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=%s&type=%s" % (accessToken,mediaType)
          request = urllib2.Request(postUrl,postData,postHeaders)
          urlResp = urllib2.urlopen(request)
          print urlResp.read()

if __name__ == '__main__':
     myMedia = Media()
     #Basic().run()
     accessToken = Basic().get_access_token()
     print "accesstoken is :%s" % accessToken
     filePath = "/var/www/html/weixin/testid/material/guzi.jpg"
     mediaType = "image"
     myMedia.upload(accessToken,filePath,mediaType)
