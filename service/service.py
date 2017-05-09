from flask import Flask, jsonify, request
from lib.facebook import Facebook
from lib.output_format import OutputFormat

fb = Facebook()

app = Flask(__name__)


@app.route('/get/fans/')
def get_fans():
    """
    Endpoint to output a fan based on a given format
    :return: 
    """
    page_id = request.args.get('page_id', None)
    out_format = request.args.get('format', OutputFormat.line_chart.value)
    result = {'error': False, 'data': fb.get_metric(page_id, 'like', out_format)}
    return jsonify(result)


@app.route('/insert/page/', methods=['POST'])
def insert_page():
    """
    Endpoint to insert a page into the database
    :return: 
    """
    if not request.is_json or 'page_id' not in request.json:
        return jsonify({'result': False}), 401

    page_id = request.json['page_id']
    fb.add_page(page_id)

    return jsonify({'result': True, 'page_id': page_id}), 201


if __name__ == '__main__':
    app.run()
