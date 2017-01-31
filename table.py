from sqlalchemy import Column, Integer, String, DateTime
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy import create_engine

Base = declarative_base()


class PageFanCount(Base):
    __tablename__ = 'pagefancount'
    id = Column(Integer, primary_key=True)
    page_name = Column(String(50), nullable=False)
    fans = Column(Integer, nullable=False)
    time = Column(DateTime, nullable=False)


engine = create_engine('sqlite:///facebook_page_fan_count.db')

Base.metadata.create_all(engine)
