import urllib2
from bs4 import BeautifulSoup
from lib.social_media import SocialMedia


class Facebook(SocialMedia):
    def __init__(self):
        """
        Class constructor
        """
        SocialMedia.__init__(self, 'facebook')

    @staticmethod
    def get_fans(fb_page_id):
        """
        Returns a number of likes of a given facebook page id
        :param fb_page_id: 
        :return: 
        """
        base_url = 'https://www.facebook.com/'
        url = base_url + fb_page_id

        response = urllib2.urlopen(url)
        soup = BeautifulSoup(response.read(), 'lxml')

        likes_count = soup.find('span', {'id': 'PagesLikesCountDOMID'})
        likes_count = likes_count.find('span', recursive=False).getText()
        likes_count = str(filter(lambda x: x.isdigit(), likes_count))

        return int(likes_count)
