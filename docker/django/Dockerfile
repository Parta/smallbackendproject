FROM python:3.5-slim
COPY . /parta
WORKDIR /parta
RUN apt-get update -y && apt-get install libproj-dev gettext libgettextpo-dev netcat -y
RUN pip install -r requirements.txt
