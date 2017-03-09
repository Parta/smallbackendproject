<?php

/* FansBundle:Default:index.html.twig */
class __TwigTemplate_447e69f128fe8e2290be1972a2e99c9a9f69190220a14b3c4825c1e74854556e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_cd88c5c3d111c3dd9f46c9937f669c9c5cec821f7a59751f36e5bc27176a7e8f = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_cd88c5c3d111c3dd9f46c9937f669c9c5cec821f7a59751f36e5bc27176a7e8f->enter($__internal_cd88c5c3d111c3dd9f46c9937f669c9c5cec821f7a59751f36e5bc27176a7e8f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FansBundle:Default:index.html.twig"));

        $__internal_93f272eed38f65585d595f188c6c3b1798386a40102b9836fe34915855702e0f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_93f272eed38f65585d595f188c6c3b1798386a40102b9836fe34915855702e0f->enter($__internal_93f272eed38f65585d595f188c6c3b1798386a40102b9836fe34915855702e0f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FansBundle:Default:index.html.twig"));

        // line 1
        echo "Hello World!
";
        
        $__internal_cd88c5c3d111c3dd9f46c9937f669c9c5cec821f7a59751f36e5bc27176a7e8f->leave($__internal_cd88c5c3d111c3dd9f46c9937f669c9c5cec821f7a59751f36e5bc27176a7e8f_prof);

        
        $__internal_93f272eed38f65585d595f188c6c3b1798386a40102b9836fe34915855702e0f->leave($__internal_93f272eed38f65585d595f188c6c3b1798386a40102b9836fe34915855702e0f_prof);

    }

    public function getTemplateName()
    {
        return "FansBundle:Default:index.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  25 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("Hello World!
", "FansBundle:Default:index.html.twig", "/Applications/MAMP/htdocs/smallbackendproject/src/FansBundle/Resources/views/Default/index.html.twig");
    }
}
