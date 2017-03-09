<?php

/* base.html.twig */
class __TwigTemplate_d81bae7d5325a7f23ba92e849144467ab8ed2421c201cbf1d70c17582ad76de7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_d0169136921fa8c651b8f79502826e177d9daf487ad5883fee313605f617166a = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_d0169136921fa8c651b8f79502826e177d9daf487ad5883fee313605f617166a->enter($__internal_d0169136921fa8c651b8f79502826e177d9daf487ad5883fee313605f617166a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_c2e6669f9c768fb9e5faf0a8ba52c65a1b0f6ee5e63a6b31d58e62fdfd2795f2 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_c2e6669f9c768fb9e5faf0a8ba52c65a1b0f6ee5e63a6b31d58e62fdfd2795f2->enter($__internal_c2e6669f9c768fb9e5faf0a8ba52c65a1b0f6ee5e63a6b31d58e62fdfd2795f2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_d0169136921fa8c651b8f79502826e177d9daf487ad5883fee313605f617166a->leave($__internal_d0169136921fa8c651b8f79502826e177d9daf487ad5883fee313605f617166a_prof);

        
        $__internal_c2e6669f9c768fb9e5faf0a8ba52c65a1b0f6ee5e63a6b31d58e62fdfd2795f2->leave($__internal_c2e6669f9c768fb9e5faf0a8ba52c65a1b0f6ee5e63a6b31d58e62fdfd2795f2_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_db6c0e39e47ac2f74877dbd80b6e64a97f29dd2562972970c4c4ad299f82974b = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_db6c0e39e47ac2f74877dbd80b6e64a97f29dd2562972970c4c4ad299f82974b->enter($__internal_db6c0e39e47ac2f74877dbd80b6e64a97f29dd2562972970c4c4ad299f82974b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_dded644f18c0b8b16253b8951217ef068f2025e50ebda63eb90bbcd12503a26b = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_dded644f18c0b8b16253b8951217ef068f2025e50ebda63eb90bbcd12503a26b->enter($__internal_dded644f18c0b8b16253b8951217ef068f2025e50ebda63eb90bbcd12503a26b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_dded644f18c0b8b16253b8951217ef068f2025e50ebda63eb90bbcd12503a26b->leave($__internal_dded644f18c0b8b16253b8951217ef068f2025e50ebda63eb90bbcd12503a26b_prof);

        
        $__internal_db6c0e39e47ac2f74877dbd80b6e64a97f29dd2562972970c4c4ad299f82974b->leave($__internal_db6c0e39e47ac2f74877dbd80b6e64a97f29dd2562972970c4c4ad299f82974b_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_5fd2ef80e4db91e163b22a696a751f7992379d27c1d1056359c5353cc97e1708 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_5fd2ef80e4db91e163b22a696a751f7992379d27c1d1056359c5353cc97e1708->enter($__internal_5fd2ef80e4db91e163b22a696a751f7992379d27c1d1056359c5353cc97e1708_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_44e82dc251f3f51a4553cb6ae160fe2458bdfa4405b7fd2616318e4d41f95de0 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_44e82dc251f3f51a4553cb6ae160fe2458bdfa4405b7fd2616318e4d41f95de0->enter($__internal_44e82dc251f3f51a4553cb6ae160fe2458bdfa4405b7fd2616318e4d41f95de0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_44e82dc251f3f51a4553cb6ae160fe2458bdfa4405b7fd2616318e4d41f95de0->leave($__internal_44e82dc251f3f51a4553cb6ae160fe2458bdfa4405b7fd2616318e4d41f95de0_prof);

        
        $__internal_5fd2ef80e4db91e163b22a696a751f7992379d27c1d1056359c5353cc97e1708->leave($__internal_5fd2ef80e4db91e163b22a696a751f7992379d27c1d1056359c5353cc97e1708_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_c77c80e15540c6aaa29522243b3f503dbf3bcb4f6ae2b97b1eec61675af893b7 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_c77c80e15540c6aaa29522243b3f503dbf3bcb4f6ae2b97b1eec61675af893b7->enter($__internal_c77c80e15540c6aaa29522243b3f503dbf3bcb4f6ae2b97b1eec61675af893b7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_c0e719329a62031becd893a5ab42688180a2fb208cb55b7dc320bfe60a9f01ad = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_c0e719329a62031becd893a5ab42688180a2fb208cb55b7dc320bfe60a9f01ad->enter($__internal_c0e719329a62031becd893a5ab42688180a2fb208cb55b7dc320bfe60a9f01ad_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_c0e719329a62031becd893a5ab42688180a2fb208cb55b7dc320bfe60a9f01ad->leave($__internal_c0e719329a62031becd893a5ab42688180a2fb208cb55b7dc320bfe60a9f01ad_prof);

        
        $__internal_c77c80e15540c6aaa29522243b3f503dbf3bcb4f6ae2b97b1eec61675af893b7->leave($__internal_c77c80e15540c6aaa29522243b3f503dbf3bcb4f6ae2b97b1eec61675af893b7_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_ca3ad021d5221b2d21f7202a51d11939adbfebf73df020326d8bceda56813a5e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_ca3ad021d5221b2d21f7202a51d11939adbfebf73df020326d8bceda56813a5e->enter($__internal_ca3ad021d5221b2d21f7202a51d11939adbfebf73df020326d8bceda56813a5e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_5977d323552eb32870ba0845167df44011b76570d1377b7bfd85e70399c2765f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_5977d323552eb32870ba0845167df44011b76570d1377b7bfd85e70399c2765f->enter($__internal_5977d323552eb32870ba0845167df44011b76570d1377b7bfd85e70399c2765f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_5977d323552eb32870ba0845167df44011b76570d1377b7bfd85e70399c2765f->leave($__internal_5977d323552eb32870ba0845167df44011b76570d1377b7bfd85e70399c2765f_prof);

        
        $__internal_ca3ad021d5221b2d21f7202a51d11939adbfebf73df020326d8bceda56813a5e->leave($__internal_ca3ad021d5221b2d21f7202a51d11939adbfebf73df020326d8bceda56813a5e_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 11,  100 => 10,  83 => 6,  65 => 5,  53 => 12,  50 => 11,  48 => 10,  41 => 7,  39 => 6,  35 => 5,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>
", "base.html.twig", "/Applications/MAMP/htdocs/smallbackendproject/app/Resources/views/base.html.twig");
    }
}
