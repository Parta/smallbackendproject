"""
Renders take data from the queryset and reformats the data to our desired format

"""
from rest_framework import renderers


class LineChartRenderer(renderers.JSONRenderer):

    def render(self, data, accepted_media_type=None, renderer_context=None):
        try:
            # our own custom method
            custom_output = {'data': {}}
            for data_point in data:
                custom_output['data'][data_point['created']] = data_point['fan_count']

            custom_output['errors'] = False
        except TypeError:
            custom_output = data

        return super(LineChartRenderer, self).render(custom_output, accepted_media_type, renderer_context)


class TableChartRenderer(renderers.JSONRenderer):

    def render(self, data, accepted_media_type=None, renderer_context=None):

        try:
            # our own custom method
            custom_output = {'data': []}
            for data_point in data:
                custom_output['data'].append({'date': data_point['created'], 'value': data_point['fan_count']})
            custom_output['errors'] = False
        except TypeError:
            custom_output = data

        return super(TableChartRenderer, self).render(custom_output, accepted_media_type, renderer_context)


class MultiPageRenderer(renderers.JSONRenderer):

    def render(self, data, accepted_media_type=None, renderer_context=None):

        # our own custom method
        try:
            custom_output = {'data': {}}
            for data_point in data:
                custom_output['data'][data_point['name']] = []
                for report in data_point['company_reports']:
                    custom_output['data'][data_point['name']].append({
                        'date': report['created'], 'value': report['fan_count']
                    })
            custom_output['errors'] = False
        except TypeError:
            custom_output = data
        return super(MultiPageRenderer, self).render(custom_output, accepted_media_type, renderer_context)
