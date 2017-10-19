"""
    Module parta
"""
from parta.exceptions import PartaException
 
class Collection(object):
    """Collection"""

    def __init__(self):
        self._children = []

    @property
    def children(self):
        """entities."""
        return self._children

    def register_children(self, *args):
        """register_children."""
        raise NotImplementedError("Subclasses should implement this!")

class BaseClass(object):
    """BaseClass"""

    def __init__(self, path, title=None):
        self._path = path
        self._title = title
        self._type = None
        self._name = None
        self._parent = None

    @property
    def title(self):
        """title."""
        return self._title

    @property
    def type(self):
        """type."""
        return self._type

    @property
    def name(self):
        """ Return Name """
        return self._name

    @property
    def path(self):
        """ Return Firebase path """
        return self._path

    @property
    def absolute_path(self):
        """absolute_path."""
        if self._parent:
            return self._parent.absolute_path + "/" + self._path
        else:
            return self._path

    @property
    def parent(self):
        """parent."""
        return self._parent

"""
    Base Class
"""
class Entity(BaseClass, Collection):
    """Entity"""
    
    TYPE_FACEBOOK = "facebook"
    TYPE_TWITTER = "twiiter"

    def __init__(self, path, compaign, page_id, title=None):
        if isinstance(compaign, Compaign):
            BaseClass.__init__(self, path, title)
            Collection.__init__(self)
        else:
            raise PartaException("Argument 2 must to be instance of Compaign")
        self._parent = compaign
        self._page_id = page_id
        self._type = None
        self._name = None
        self._url = None

    @property
    def page_id(self):
        """page_id."""
        return self._page_id

    @property
    def url(self):
        """url."""
        return "http://" + self._url

    @property
    def secure_url(self):
        """secure_url."""
        return "https://" +  self._url

    @property
    def page_url(self):
        """page_url."""
        return self.url + "/" + self._page_id

    @property
    def secure_page_url(self):
        """secure_page_url."""
        return self.secure_url + "/" + self._page_id

    @property
    def components(self):
        """components."""
        return self._children

    def register_children(self, *args):
        """register_children."""
        for component in args:
            if isinstance(component, Component):
                if component.parent == self:
                    self._children.append(component)
                else:
                    message = "The given instance of Component did'nt belong"\
                     "to the current Entity instance!."
                    raise PartaException(message)
            else:
                message = "Unsupported Object! Arguments must to be instance of Component."
                raise PartaException(message)


class Component(BaseClass, Collection):
    """
    Component Class
    """
    TYPE_FANS_COUNT = "fans_count"

    def __init__(self, path, entity, title=None):
        if isinstance(entity, Entity):
            path = "components/" + path
            BaseClass.__init__(self, path, title)
            Collection.__init__(self)
        else:
            raise PartaException("Argument 2 must to be instance of Entity")
        self._parent = entity
        self._elements = []

    @property
    def elements(self):
        """elements."""
        return self._children

    def register_children(self, *args):
        """register_children."""
        for element in args:
            if isinstance(element, Element):
                if element.parent == self:
                    self._children.append(element)
                else:
                    message = "The given instance of Element did'nt belong"\
                     "to the current Component instance!."
                    raise PartaException(message)
            else:
                message = "Unsupported Object! Arguments must to be instance of Element."
                raise PartaException(message)

class Element(BaseClass):
    """
    Element Class
    """
    def __init__(self, path, component, title=None):
        if isinstance(component, Component):
            path = "elements/" + path
            super(Element, self).__init__(path, title)
        else:
            raise PartaException("Argument 2 must to be instance of Component")
        self._parent = component
        self._data = None

    @property
    def data(self):
        """data"""
        return self._data

    @data.setter
    def data(self, data):
        """data"""
        self._data = data

class Compaign(BaseClass, Collection):
    """
    Compaign Class
    """

    def __init__(self, path, title=None):
        path = "compaigns/" + path
        BaseClass.__init__(self, path, title)
        Collection.__init__(self)
        self._name = "compaign"

    def register_children(self, *args):
        """register_children."""
        for entity in args:
            if isinstance(entity, Entity):
                if entity.parent == self:
                    self._children.append(entity)
                else:
                    message = "The given instance of Entity did'nt belong"\
                     "to the current Compaign instance!."
                    raise PartaException(message)
            else:
                message = "Unsupported Object! Argument 1 must to be instance of Entity."
                raise PartaException(message)

"""
Facebook Class
"""
class FacebookEntity(Entity):
    """
    Facebook
    """""

    def __init__(self, compaign, page_id, title=None):
        path = "entities/facebook"
        super(FacebookEntity, self).__init__(path, compaign, page_id, title)
        self._url = "www.facebook.com"
        self._page_id = page_id
        self._name = "facebook"
        self._type = Entity.TYPE_FACEBOOK

"""
Twitter Class
"""
class TwitterEntity(Entity):
    """
    Twitter
    """""

    def __init__(self, compaign, page_id, title=None):
        path = "entities/twitter"
        super(TwitterEntity, self).__init__(path, compaign, page_id, title)
        self._url = "www.twitter.com"
        self._page_id = page_id
        self._name = "twitter"
        self._type = Entity.TYPE_TWITTER

class FansCountComponent(Component):
    """
    FanCount Class
    """
    def __init__(self, entity, title=None):
        path = "fans_count"
        super(FansCountComponent, self).__init__(path, entity, title)
        self._name = "fans_count"
        self._type = Component.TYPE_FANS_COUNT
