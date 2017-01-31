from flask import Flask
from flask.json import jsonify
import apiservice as service

app = Flask(__name__)


@app.route('/api/<string:page_name>/fancount/<string:format>', methods=['GET'])
def get_fan_count_formatted(page_name, format):
    return jsonify(service.fan_count_service(page_name, format))


@app.route('/api/<string:page_name>/fancount/', methods=['GET'])
def get_fan_count_default(page_name):
    return jsonify(service.fan_count_service(page_name))


if __name__ == '__main__':
    app.run()
