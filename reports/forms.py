from django import forms
from django.core.exceptions import ValidationError
from .facebookservice import get_page_id
from .models import Report, Company


class CreateReportForm(forms.ModelForm):
    class Meta:
        model = Report
        fields = '__all__'


class CreateCompanyForm(forms.ModelForm):
    class Meta:
        model = Company
        fields = ('name', )

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.page_id = None

    def clean(self):
        page_id = get_page_id(self.cleaned_data['name'])
        if page_id:
            self.page_id = page_id
        else:
            raise ValidationError('Page Id could not be form by {}'.format(self.cleaned_data['name']))

    def save(self, commit=True):
        instance = super(CreateCompanyForm, self).save(commit=False)
        if self.page_id is not None:
            instance.page_id = self.page_id
        if commit:
            instance.save()
        return instance
