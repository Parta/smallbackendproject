"""
Crawlers
"""
from parta.exceptions import PartaException
from parta.models import Entity
from parta.parsers import Parser

class Crawler(object):
    """
    Crawler
    """

    CRAWLER_FANS_COUNT = "crawler/fans_count"

    def __init__(self, entity):
        """constructor."""
        if not isinstance(entity, Entity):
            raise PartaException("Argument 1 must to be instance of Entity")
        self._parsers = {}
        self._entity = entity

    def execute(self, parser_type):
        """execute."""
        if self._parsers and self._parsers[parser_type]:
            return self._parsers[parser_type].run()

    @property
    def parsers(self):
        """parsers."""
        return self._parsers

    @property
    def entity(self):
        """component."""
        return self._entity

    def register_parsers(self, *args):
        """register_parsers."""
        for parser in args:
            if isinstance(parser, Parser):
                self._parsers[parser.type] = parser
            else:
                message = "Unsupported Object! Arguments must to be instance of Parser."
                raise PartaException(message)
