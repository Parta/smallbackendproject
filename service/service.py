from flask import Flask, jsonify, abort, request
from dal.fan_page_dal import FanRepository
from dateutil.parser import parse

app = Flask(__name__)
fan_repository = FanRepository()


@app.route('/fans/<page_id>/format/<type>/limit/<int:limit>', methods=["GET"])
def get_count(page_id, type, limit):
    try:
        documents = fan_repository.get_fan_count(fan_name=page_id, limit=limit)
        return jsonify(
            {
                "error": False,
                "data": __process_response(documents=documents, format=type)
            })
    except Exception as e:
        # TODO: Log to handle the exception
        abort(e)


@app.route('/fans', methods=["POST"])
def post_count():
    try:
        input_json = request.json
        page_ids = input_json.get("page_ids")
        limit = input_json.get("limit")
        documents = fan_repository.get_fan_counts(limit, *page_ids)
        return jsonify({
            "error": False,
            "data": __process_response(documents=documents, format="multiplepage", page_ids=page_ids)})
    except Exception as e:
        # TODO: Log to handle the exception
        abort(500)


def __process_response(documents, format, page_ids=None):
    if format == "linechart":
        return format_linechart(documents)
    elif format == "table":
        return format_table(documents)
    elif format == "multiplepage":
        return format_multiple_page(documents, page_ids)
    else:
        # TODO: Log the bad request.
        abort(400)


def format_linechart(documents):
    """

    :param documents: The list of documents matching the page_id
    :return: The documents in table format.
    """
    return [
        {"date": str(parse(document.get("time")).timestamp()).split(".")[0],
         "value": document.get("fan_count")

         } for document in documents]


def format_table(documents):
    """

    :param documents: The list of documents matching the page_id
    :return: the key is timestamp the value is count.
        Ex :{
            "23423543534345":45,
            "23423543634345":50,
            "23423543734345":55
        }
    """

    return {
        str(parse(document.get("time")).timestamp()).split(".")[0]: document.get("fan_count")
        for document in documents
        }


def format_multiple_page(documents, page_ids):
    """

    :param documents: A lit of documents
    :param page_ids: The page_id in question.
    :return: {
            "cocacola":[
                {
                    "date": "23423543534345",
                    "value": 45
                },
                {
                    "date": "23423543634345",
                    "value": 50
                },
                {
                    "date": "23423543734345",
                    "value": 55
                }
            ],
            "nytimes":[
                {
                    "date": "23423543534345",
                    "value": 45
                }
            ]
        }
    """
    acc = {page_id: [] for page_id in page_ids}
    for document in documents:
        acc[document.get("fan_name")].append(
            {"date": str(parse(document.get("time")).timestamp()).split(".")[0],
             "value": document.get("fan_count")})

    return acc


if __name__ == '__main__':
    app.run(debug=True)
