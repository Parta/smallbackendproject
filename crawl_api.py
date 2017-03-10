import sqlite3

from collections import defaultdict
from crawl import DEFAULT_DB_PATH
from flask import Flask, jsonify

app = Flask(__name__)
app.config.from_object(__name__)

DATA_FORMATS = ['linechart', 'table', 'multiplepage']

@app.route('/fans/<page_id>/format/<data_format>')
def get_fan_stats(page_id, data_format):
    error = False
    data = {}

    selectPageId = "SELECT * FROM fan_tracker WHERE fb_page_id = ?"
    page_id = str(page_id).strip()

    if data_format not in DATA_FORMATS:
        error = True
    else:
        conn = sqlite3.connect(DEFAULT_DB_PATH)
        cur = conn.cursor()
        cur.execute(selectPageId, (page_id,))
        result = cur.fetchall()

        if not result:
            error = True
        else:
            data = format_data(data_format, result)
            error = not bool(data)

    api_response = dict(error=error, data=data)

    return jsonify(api_response)

def format_data(data_format, resultset):

    table_data = None

    if data_format == 'table':
        table_data = {}
        for row in resultset:
            table_data[row[3]] = row[2]

    if data_format == 'linechart':
        table_data = []
        for row in resultset:
            table_data.append({
                "date": row[3],
                "value": row[2]
            })

    if data_format == 'multiplepage':
        table_data = defaultdict(list)
        for row in resultset:
            table_data[row[1]].append({
                "date": row[3],
                "value": row[2]
            })

    return table_data

if __name__ == '__main__':
    app.run(debug=True)
