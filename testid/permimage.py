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
      def add_news(self,accessToken,filePath,mediaType):
          openFile = open(filePath,"rb")
          param = {'media':openFile}
          postData,postHeaders = poster.encode.multipart_encode(param)
          postUrl = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=%s&type=%s" % (accessToken,mediaType)
          #postUrl = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=%s&type=%s" % (accessToken,mediaType)
          print postUrl
          request = urllib2.Request(postUrl,postData,postHeaders)
          urlResp = urllib2.urlopen(request)
          print urlResp.read()

if __name__ == '__main__':
     myMaterial = Material()
     accessToken = Basic().get_access_token()
     print "accesstoken is :%s" % accessToken
     
     filePath="material/guzi.jpg"
     mediaType = "image"
  
     myMaterial.add_news(accessToken,filePath,mediaType)
