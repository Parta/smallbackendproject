<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_490088ef8c2d536ba9aa3e4da532e3c9d5d6875dde7bb492995d7d77f4e311f2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_8c2ee03e811126953605b6a532e4b4842bc2e34211ef2cd3054682bf329694c7 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_8c2ee03e811126953605b6a532e4b4842bc2e34211ef2cd3054682bf329694c7->enter($__internal_8c2ee03e811126953605b6a532e4b4842bc2e34211ef2cd3054682bf329694c7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $__internal_e73b86ba7f668bd6e8b71ac89992822d52e7db8964e67fd40f0d21c96092df7a = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_e73b86ba7f668bd6e8b71ac89992822d52e7db8964e67fd40f0d21c96092df7a->enter($__internal_e73b86ba7f668bd6e8b71ac89992822d52e7db8964e67fd40f0d21c96092df7a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_8c2ee03e811126953605b6a532e4b4842bc2e34211ef2cd3054682bf329694c7->leave($__internal_8c2ee03e811126953605b6a532e4b4842bc2e34211ef2cd3054682bf329694c7_prof);

        
        $__internal_e73b86ba7f668bd6e8b71ac89992822d52e7db8964e67fd40f0d21c96092df7a->leave($__internal_e73b86ba7f668bd6e8b71ac89992822d52e7db8964e67fd40f0d21c96092df7a_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_c0de2b31c02cfc5723358e4635fd1113e7627f65708d2c944f348059891ed950 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_c0de2b31c02cfc5723358e4635fd1113e7627f65708d2c944f348059891ed950->enter($__internal_c0de2b31c02cfc5723358e4635fd1113e7627f65708d2c944f348059891ed950_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        $__internal_8e27422bdcf9803ae6b68c4eadcdea11485d0314d3ea06a64e212a41f43aef07 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_8e27422bdcf9803ae6b68c4eadcdea11485d0314d3ea06a64e212a41f43aef07->enter($__internal_8e27422bdcf9803ae6b68c4eadcdea11485d0314d3ea06a64e212a41f43aef07_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_8e27422bdcf9803ae6b68c4eadcdea11485d0314d3ea06a64e212a41f43aef07->leave($__internal_8e27422bdcf9803ae6b68c4eadcdea11485d0314d3ea06a64e212a41f43aef07_prof);

        
        $__internal_c0de2b31c02cfc5723358e4635fd1113e7627f65708d2c944f348059891ed950->leave($__internal_c0de2b31c02cfc5723358e4635fd1113e7627f65708d2c944f348059891ed950_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_405d892700e1e19d8e882b0d872d68c371b48fb64de7ea4848345bf3aa666bd5 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_405d892700e1e19d8e882b0d872d68c371b48fb64de7ea4848345bf3aa666bd5->enter($__internal_405d892700e1e19d8e882b0d872d68c371b48fb64de7ea4848345bf3aa666bd5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        $__internal_2f108a0fdf3f06f86742398e9cda3166aef304219a690d09cca2d846103dd80c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_2f108a0fdf3f06f86742398e9cda3166aef304219a690d09cca2d846103dd80c->enter($__internal_2f108a0fdf3f06f86742398e9cda3166aef304219a690d09cca2d846103dd80c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_2f108a0fdf3f06f86742398e9cda3166aef304219a690d09cca2d846103dd80c->leave($__internal_2f108a0fdf3f06f86742398e9cda3166aef304219a690d09cca2d846103dd80c_prof);

        
        $__internal_405d892700e1e19d8e882b0d872d68c371b48fb64de7ea4848345bf3aa666bd5->leave($__internal_405d892700e1e19d8e882b0d872d68c371b48fb64de7ea4848345bf3aa666bd5_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_e4543b9b3a846e74ac3ea6884584bbbdbed1666b6cd4fc7b892600e7892cfc2c = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_e4543b9b3a846e74ac3ea6884584bbbdbed1666b6cd4fc7b892600e7892cfc2c->enter($__internal_e4543b9b3a846e74ac3ea6884584bbbdbed1666b6cd4fc7b892600e7892cfc2c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        $__internal_918ff2d0180f2912a74cbb29fb8b54b362db8f56f0929c0f9417d11994e3a9a9 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_918ff2d0180f2912a74cbb29fb8b54b362db8f56f0929c0f9417d11994e3a9a9->enter($__internal_918ff2d0180f2912a74cbb29fb8b54b362db8f56f0929c0f9417d11994e3a9a9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_router", array("token" => ($context["token"] ?? $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_918ff2d0180f2912a74cbb29fb8b54b362db8f56f0929c0f9417d11994e3a9a9->leave($__internal_918ff2d0180f2912a74cbb29fb8b54b362db8f56f0929c0f9417d11994e3a9a9_prof);

        
        $__internal_e4543b9b3a846e74ac3ea6884584bbbdbed1666b6cd4fc7b892600e7892cfc2c->leave($__internal_e4543b9b3a846e74ac3ea6884584bbbdbed1666b6cd4fc7b892600e7892cfc2c_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 13,  85 => 12,  71 => 7,  68 => 6,  59 => 5,  42 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
", "@WebProfiler/Collector/router.html.twig", "/Applications/MAMP/htdocs/smallbackendproject/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views/Collector/router.html.twig");
    }
}
