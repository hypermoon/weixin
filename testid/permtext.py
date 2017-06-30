#filename:media.py
from basic import Basic
import urllib2
import json

class Material(object):
      #def __init__(self):
      #    register_openers()
      def add_news(self,accessToken,news):
          postUrl = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=%s" % accessToken
          urlResp = urllib2.urlopen(postUrl,news)
          print urlResp.read()

if __name__ == '__main__':
     myMaterial = Material()
     accessToken = Basic().get_access_token()
     print "accesstoken is :%s" % accessToken
     
  
     news=(
     {
       "filter":
        {
          "is_to_all":True,
          "tag_id":2
        },
       "text":
        {
          "content":"Test send mass message to tag people"
        },
        "msgtype":"text"
       
     })

     news=json.dumps(news,ensure_ascii=False)
     myMaterial.add_news(accessToken,news)
