<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_f5a4e4e47a61dbc596b8a5cf6c4251cf9809cbaa7fe0192c935bf3aa4bd7f2e4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_518691e7ccc8a536fbe0942c09bb92125524a55f4c96b9593ee9813ce6740735 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_518691e7ccc8a536fbe0942c09bb92125524a55f4c96b9593ee9813ce6740735->enter($__internal_518691e7ccc8a536fbe0942c09bb92125524a55f4c96b9593ee9813ce6740735_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $__internal_74c72adf64b61b1809322c99d724dfef993b242d2a239934c06c90ccc3fe484d = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_74c72adf64b61b1809322c99d724dfef993b242d2a239934c06c90ccc3fe484d->enter($__internal_74c72adf64b61b1809322c99d724dfef993b242d2a239934c06c90ccc3fe484d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_518691e7ccc8a536fbe0942c09bb92125524a55f4c96b9593ee9813ce6740735->leave($__internal_518691e7ccc8a536fbe0942c09bb92125524a55f4c96b9593ee9813ce6740735_prof);

        
        $__internal_74c72adf64b61b1809322c99d724dfef993b242d2a239934c06c90ccc3fe484d->leave($__internal_74c72adf64b61b1809322c99d724dfef993b242d2a239934c06c90ccc3fe484d_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_4c48f9cff42bab0b05988dedb4704800a59bd89257c5b47dc668fe791b96a172 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_4c48f9cff42bab0b05988dedb4704800a59bd89257c5b47dc668fe791b96a172->enter($__internal_4c48f9cff42bab0b05988dedb4704800a59bd89257c5b47dc668fe791b96a172_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        $__internal_2724c66851a1e411eab237546cc8fab974436b001b84225baf01b7bb0a560c34 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_2724c66851a1e411eab237546cc8fab974436b001b84225baf01b7bb0a560c34->enter($__internal_2724c66851a1e411eab237546cc8fab974436b001b84225baf01b7bb0a560c34_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <style>
        .sf-reset .traces {
            padding-bottom: 14px;
        }
        .sf-reset .traces li {
            font-size: 12px;
            color: #868686;
            padding: 5px 4px;
            list-style-type: decimal;
            margin-left: 20px;
        }
        .sf-reset #logs .traces li.error {
            font-style: normal;
            color: #AA3333;
            background: #f9ecec;
        }
        .sf-reset #logs .traces li.warning {
            font-style: normal;
            background: #ffcc00;
        }
        /* fix for Opera not liking empty <li> */
        .sf-reset .traces li:after {
            content: \"\\00A0\";
        }
        .sf-reset .trace {
            border: 1px solid #D3D3D3;
            padding: 10px;
            overflow: auto;
            margin: 10px 0 20px;
        }
        .sf-reset .block-exception {
            -moz-border-radius: 16px;
            -webkit-border-radius: 16px;
            border-radius: 16px;
            margin-bottom: 20px;
            background-color: #f6f6f6;
            border: 1px solid #dfdfdf;
            padding: 30px 28px;
            word-wrap: break-word;
            overflow: hidden;
        }
        .sf-reset .block-exception div {
            color: #313131;
            font-size: 10px;
        }
        .sf-reset .block-exception-detected .illustration-exception,
        .sf-reset .block-exception-detected .text-exception {
            float: left;
        }
        .sf-reset .block-exception-detected .illustration-exception {
            width: 152px;
        }
        .sf-reset .block-exception-detected .text-exception {
            width: 670px;
            padding: 30px 44px 24px 46px;
            position: relative;
        }
        .sf-reset .text-exception .open-quote,
        .sf-reset .text-exception .close-quote {
            font-family: Arial, Helvetica, sans-serif;
            position: absolute;
            color: #C9C9C9;
            font-size: 8em;
        }
        .sf-reset .open-quote {
            top: 0;
            left: 0;
        }
        .sf-reset .close-quote {
            bottom: -0.5em;
            right: 50px;
        }
        .sf-reset .block-exception p {
            font-family: Arial, Helvetica, sans-serif;
        }
        .sf-reset .block-exception p a,
        .sf-reset .block-exception p a:hover {
            color: #565656;
        }
        .sf-reset .logs h2 {
            float: left;
            width: 654px;
        }
        .sf-reset .error-count, .sf-reset .support {
            float: right;
            width: 170px;
            text-align: right;
        }
        .sf-reset .error-count span {
             display: inline-block;
             background-color: #aacd4e;
             -moz-border-radius: 6px;
             -webkit-border-radius: 6px;
             border-radius: 6px;
             padding: 4px;
             color: white;
             margin-right: 2px;
             font-size: 11px;
             font-weight: bold;
        }

        .sf-reset .support a {
            display: inline-block;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            padding: 4px;
            color: #000000;
            margin-right: 2px;
            font-size: 11px;
            font-weight: bold;
        }

        .sf-reset .toggle {
            vertical-align: middle;
        }
        .sf-reset .linked ul,
        .sf-reset .linked li {
            display: inline;
        }
        .sf-reset #output-content {
            color: #000;
            font-size: 12px;
        }
        .sf-reset #traces-text pre {
            white-space: pre;
            font-size: 12px;
            font-family: monospace;
        }
    </style>
";
        
        $__internal_2724c66851a1e411eab237546cc8fab974436b001b84225baf01b7bb0a560c34->leave($__internal_2724c66851a1e411eab237546cc8fab974436b001b84225baf01b7bb0a560c34_prof);

        
        $__internal_4c48f9cff42bab0b05988dedb4704800a59bd89257c5b47dc668fe791b96a172->leave($__internal_4c48f9cff42bab0b05988dedb4704800a59bd89257c5b47dc668fe791b96a172_prof);

    }

    // line 136
    public function block_title($context, array $blocks = array())
    {
        $__internal_7fb9f9c6908323c28531c10b4f927d7a52c1849e580711a134f1b77e45b36ee0 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_7fb9f9c6908323c28531c10b4f927d7a52c1849e580711a134f1b77e45b36ee0->enter($__internal_7fb9f9c6908323c28531c10b4f927d7a52c1849e580711a134f1b77e45b36ee0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_f896e1b5f0218f0e90c71677acde74cfd01df16bd99fe0e427ba49159b548a6c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_f896e1b5f0218f0e90c71677acde74cfd01df16bd99fe0e427ba49159b548a6c->enter($__internal_f896e1b5f0218f0e90c71677acde74cfd01df16bd99fe0e427ba49159b548a6c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 137
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["exception"] ?? $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, ($context["status_code"] ?? $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["status_text"] ?? $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_f896e1b5f0218f0e90c71677acde74cfd01df16bd99fe0e427ba49159b548a6c->leave($__internal_f896e1b5f0218f0e90c71677acde74cfd01df16bd99fe0e427ba49159b548a6c_prof);

        
        $__internal_7fb9f9c6908323c28531c10b4f927d7a52c1849e580711a134f1b77e45b36ee0->leave($__internal_7fb9f9c6908323c28531c10b4f927d7a52c1849e580711a134f1b77e45b36ee0_prof);

    }

    // line 140
    public function block_body($context, array $blocks = array())
    {
        $__internal_3f2a44132b27723621230db5cbdcac3b3498bf1ea4a59d3a21044ec592eed17a = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_3f2a44132b27723621230db5cbdcac3b3498bf1ea4a59d3a21044ec592eed17a->enter($__internal_3f2a44132b27723621230db5cbdcac3b3498bf1ea4a59d3a21044ec592eed17a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_940ff4346cc6c539ed02c124ad978a32f01e032c3a3f9ea4636f3675c813272f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_940ff4346cc6c539ed02c124ad978a32f01e032c3a3f9ea4636f3675c813272f->enter($__internal_940ff4346cc6c539ed02c124ad978a32f01e032c3a3f9ea4636f3675c813272f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 141
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 141)->display($context);
        
        $__internal_940ff4346cc6c539ed02c124ad978a32f01e032c3a3f9ea4636f3675c813272f->leave($__internal_940ff4346cc6c539ed02c124ad978a32f01e032c3a3f9ea4636f3675c813272f_prof);

        
        $__internal_3f2a44132b27723621230db5cbdcac3b3498bf1ea4a59d3a21044ec592eed17a->leave($__internal_3f2a44132b27723621230db5cbdcac3b3498bf1ea4a59d3a21044ec592eed17a_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  226 => 141,  217 => 140,  200 => 137,  191 => 136,  51 => 4,  42 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@Twig/layout.html.twig' %}

{% block head %}
    <style>
        .sf-reset .traces {
            padding-bottom: 14px;
        }
        .sf-reset .traces li {
            font-size: 12px;
            color: #868686;
            padding: 5px 4px;
            list-style-type: decimal;
            margin-left: 20px;
        }
        .sf-reset #logs .traces li.error {
            font-style: normal;
            color: #AA3333;
            background: #f9ecec;
        }
        .sf-reset #logs .traces li.warning {
            font-style: normal;
            background: #ffcc00;
        }
        /* fix for Opera not liking empty <li> */
        .sf-reset .traces li:after {
            content: \"\\00A0\";
        }
        .sf-reset .trace {
            border: 1px solid #D3D3D3;
            padding: 10px;
            overflow: auto;
            margin: 10px 0 20px;
        }
        .sf-reset .block-exception {
            -moz-border-radius: 16px;
            -webkit-border-radius: 16px;
            border-radius: 16px;
            margin-bottom: 20px;
            background-color: #f6f6f6;
            border: 1px solid #dfdfdf;
            padding: 30px 28px;
            word-wrap: break-word;
            overflow: hidden;
        }
        .sf-reset .block-exception div {
            color: #313131;
            font-size: 10px;
        }
        .sf-reset .block-exception-detected .illustration-exception,
        .sf-reset .block-exception-detected .text-exception {
            float: left;
        }
        .sf-reset .block-exception-detected .illustration-exception {
            width: 152px;
        }
        .sf-reset .block-exception-detected .text-exception {
            width: 670px;
            padding: 30px 44px 24px 46px;
            position: relative;
        }
        .sf-reset .text-exception .open-quote,
        .sf-reset .text-exception .close-quote {
            font-family: Arial, Helvetica, sans-serif;
            position: absolute;
            color: #C9C9C9;
            font-size: 8em;
        }
        .sf-reset .open-quote {
            top: 0;
            left: 0;
        }
        .sf-reset .close-quote {
            bottom: -0.5em;
            right: 50px;
        }
        .sf-reset .block-exception p {
            font-family: Arial, Helvetica, sans-serif;
        }
        .sf-reset .block-exception p a,
        .sf-reset .block-exception p a:hover {
            color: #565656;
        }
        .sf-reset .logs h2 {
            float: left;
            width: 654px;
        }
        .sf-reset .error-count, .sf-reset .support {
            float: right;
            width: 170px;
            text-align: right;
        }
        .sf-reset .error-count span {
             display: inline-block;
             background-color: #aacd4e;
             -moz-border-radius: 6px;
             -webkit-border-radius: 6px;
             border-radius: 6px;
             padding: 4px;
             color: white;
             margin-right: 2px;
             font-size: 11px;
             font-weight: bold;
        }

        .sf-reset .support a {
            display: inline-block;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            padding: 4px;
            color: #000000;
            margin-right: 2px;
            font-size: 11px;
            font-weight: bold;
        }

        .sf-reset .toggle {
            vertical-align: middle;
        }
        .sf-reset .linked ul,
        .sf-reset .linked li {
            display: inline;
        }
        .sf-reset #output-content {
            color: #000;
            font-size: 12px;
        }
        .sf-reset #traces-text pre {
            white-space: pre;
            font-size: 12px;
            font-family: monospace;
        }
    </style>
{% endblock %}

{% block title %}
    {{ exception.message }} ({{ status_code }} {{ status_text }})
{% endblock %}

{% block body %}
    {% include '@Twig/Exception/exception.html.twig' %}
{% endblock %}
", "@Twig/Exception/exception_full.html.twig", "/Applications/MAMP/htdocs/smallbackendproject/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/views/Exception/exception_full.html.twig");
    }
}
