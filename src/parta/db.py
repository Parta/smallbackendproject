"""
db.py
"""

from parta.exceptions import PartaException

class Database(object):
    """
    db
    """
    def write(self, *args):
        """write."""
        raise NotImplementedError("Subclasses should implement this!")

    def read(self, path):
        """read."""
        raise NotImplementedError("Subclasses should implement this!")

    def push(self, arg):
        """push."""
        raise NotImplementedError("Subclasses should implement this!")

class Firebase(Database):
    """
    Firebase
    """
    def __init__(self, config):
        self._token = None
        self._db = None
        import pyrebase
        if config["firebase"]:
            firebase_access = config['firebase']
            if firebase_access['credentials']:
                credentials = firebase_access['credentials']
                if credentials['email'] and credentials['password']:
                    firebase = pyrebase.initialize_app(firebase_access)
                    email = credentials['email']
                    password = credentials['password']
                    auth = firebase.auth()
                    user = auth.sign_in_with_email_and_password(email, password)                    
                    user = auth.refresh(user['refreshToken'])
                    if user and user['idToken']:
                        self._token = user['idToken']
                        self._db = firebase.database()

    def write(self, *args):
        """write."""
        if self._token:
            for arg in args:
            #keys = arg.data.keys()
                path = arg.absolute_path
                node = self._db.child(path)
                node.set(arg.data, self._token)
        else:
            raise PartaException("User token is not set! Please check if your config file")

    def push(self, key, arg):
        """write."""
        if self._token:
            path = arg.absolute_path + "/" + key
            node = self._db.child(path)
            node.set(arg.data, self._token)
        else:
            raise PartaException("User token is not set! Please check if your config file")

    def read(self, path):
        """read."""
        child = self._db.child(path).get(self._token)
        return child
