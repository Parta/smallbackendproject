<?php

/* @WebProfiler/Collector/exception.html.twig */
class __TwigTemplate_12f738d54aff3bf3f6a56dc81f2505fdcba5d762d3d028c6a50f1a44ad74da5e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/exception.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
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
        $__internal_ecaca535859eb24df47a8c53f73e3f660225b570e714e4a519d0ab22d3d33fb9 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_ecaca535859eb24df47a8c53f73e3f660225b570e714e4a519d0ab22d3d33fb9->enter($__internal_ecaca535859eb24df47a8c53f73e3f660225b570e714e4a519d0ab22d3d33fb9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/exception.html.twig"));

        $__internal_372c966b7ab161f76c81cda8d0b81820e725571779ee5152eab626740ef07c57 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_372c966b7ab161f76c81cda8d0b81820e725571779ee5152eab626740ef07c57->enter($__internal_372c966b7ab161f76c81cda8d0b81820e725571779ee5152eab626740ef07c57_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/exception.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ecaca535859eb24df47a8c53f73e3f660225b570e714e4a519d0ab22d3d33fb9->leave($__internal_ecaca535859eb24df47a8c53f73e3f660225b570e714e4a519d0ab22d3d33fb9_prof);

        
        $__internal_372c966b7ab161f76c81cda8d0b81820e725571779ee5152eab626740ef07c57->leave($__internal_372c966b7ab161f76c81cda8d0b81820e725571779ee5152eab626740ef07c57_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_119fca88afeaac5019ce300ebc6750eccef6dd94f9626c970a55cb41e1428ecd = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_119fca88afeaac5019ce300ebc6750eccef6dd94f9626c970a55cb41e1428ecd->enter($__internal_119fca88afeaac5019ce300ebc6750eccef6dd94f9626c970a55cb41e1428ecd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        $__internal_1a84a273076745ff5502fce6cd123be225484a9bbb8dac9b448036f46cc92105 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_1a84a273076745ff5502fce6cd123be225484a9bbb8dac9b448036f46cc92105->enter($__internal_1a84a273076745ff5502fce6cd123be225484a9bbb8dac9b448036f46cc92105_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    ";
        if ($this->getAttribute(($context["collector"] ?? $this->getContext($context, "collector")), "hasexception", array())) {
            // line 5
            echo "        <style>
            ";
            // line 6
            echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_exception_css", array("token" => ($context["token"] ?? $this->getContext($context, "token")))));
            echo "
        </style>
    ";
        }
        // line 9
        echo "    ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
";
        
        $__internal_1a84a273076745ff5502fce6cd123be225484a9bbb8dac9b448036f46cc92105->leave($__internal_1a84a273076745ff5502fce6cd123be225484a9bbb8dac9b448036f46cc92105_prof);

        
        $__internal_119fca88afeaac5019ce300ebc6750eccef6dd94f9626c970a55cb41e1428ecd->leave($__internal_119fca88afeaac5019ce300ebc6750eccef6dd94f9626c970a55cb41e1428ecd_prof);

    }

    // line 12
    public function block_menu($context, array $blocks = array())
    {
        $__internal_a0c0bf52ecbc52526df5aa5208bb77d257d23f51c30fa73f226cdad6b27d5d1e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_a0c0bf52ecbc52526df5aa5208bb77d257d23f51c30fa73f226cdad6b27d5d1e->enter($__internal_a0c0bf52ecbc52526df5aa5208bb77d257d23f51c30fa73f226cdad6b27d5d1e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        $__internal_8b112f21275142b82b77e948ca4e98529f7383283f15d379fa672a37620f7be2 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_8b112f21275142b82b77e948ca4e98529f7383283f15d379fa672a37620f7be2->enter($__internal_8b112f21275142b82b77e948ca4e98529f7383283f15d379fa672a37620f7be2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 13
        echo "    <span class=\"label ";
        echo (($this->getAttribute(($context["collector"] ?? $this->getContext($context, "collector")), "hasexception", array())) ? ("label-status-error") : ("disabled"));
        echo "\">
        <span class=\"icon\">";
        // line 14
        echo twig_include($this->env, $context, "@WebProfiler/Icon/exception.svg");
        echo "</span>
        <strong>Exception</strong>
        ";
        // line 16
        if ($this->getAttribute(($context["collector"] ?? $this->getContext($context, "collector")), "hasexception", array())) {
            // line 17
            echo "            <span class=\"count\">
                <span>1</span>
            </span>
        ";
        }
        // line 21
        echo "    </span>
";
        
        $__internal_8b112f21275142b82b77e948ca4e98529f7383283f15d379fa672a37620f7be2->leave($__internal_8b112f21275142b82b77e948ca4e98529f7383283f15d379fa672a37620f7be2_prof);

        
        $__internal_a0c0bf52ecbc52526df5aa5208bb77d257d23f51c30fa73f226cdad6b27d5d1e->leave($__internal_a0c0bf52ecbc52526df5aa5208bb77d257d23f51c30fa73f226cdad6b27d5d1e_prof);

    }

    // line 24
    public function block_panel($context, array $blocks = array())
    {
        $__internal_3f52cef53082426186b5eb22c665798d3ceee7f33df9010ff68540ac447d3f8e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_3f52cef53082426186b5eb22c665798d3ceee7f33df9010ff68540ac447d3f8e->enter($__internal_3f52cef53082426186b5eb22c665798d3ceee7f33df9010ff68540ac447d3f8e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        $__internal_dc209ab9aa0a927c049295b24f6140bd4d30388b0487e2e7517d850c7ed28409 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_dc209ab9aa0a927c049295b24f6140bd4d30388b0487e2e7517d850c7ed28409->enter($__internal_dc209ab9aa0a927c049295b24f6140bd4d30388b0487e2e7517d850c7ed28409_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 25
        echo "    <h2>Exceptions</h2>

    ";
        // line 27
        if ( !$this->getAttribute(($context["collector"] ?? $this->getContext($context, "collector")), "hasexception", array())) {
            // line 28
            echo "        <div class=\"empty\">
            <p>No exception was thrown and caught during the request.</p>
        </div>
    ";
        } else {
            // line 32
            echo "        <div class=\"sf-reset\">
            ";
            // line 33
            echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_exception", array("token" => ($context["token"] ?? $this->getContext($context, "token")))));
            echo "
        </div>
    ";
        }
        
        $__internal_dc209ab9aa0a927c049295b24f6140bd4d30388b0487e2e7517d850c7ed28409->leave($__internal_dc209ab9aa0a927c049295b24f6140bd4d30388b0487e2e7517d850c7ed28409_prof);

        
        $__internal_3f52cef53082426186b5eb22c665798d3ceee7f33df9010ff68540ac447d3f8e->leave($__internal_3f52cef53082426186b5eb22c665798d3ceee7f33df9010ff68540ac447d3f8e_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/exception.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 33,  135 => 32,  129 => 28,  127 => 27,  123 => 25,  114 => 24,  103 => 21,  97 => 17,  95 => 16,  90 => 14,  85 => 13,  76 => 12,  63 => 9,  57 => 6,  54 => 5,  51 => 4,  42 => 3,  11 => 1,);
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

{% block head %}
    {% if collector.hasexception %}
        <style>
            {{ render(path('_profiler_exception_css', { token: token })) }}
        </style>
    {% endif %}
    {{ parent() }}
{% endblock %}

{% block menu %}
    <span class=\"label {{ collector.hasexception ? 'label-status-error' : 'disabled' }}\">
        <span class=\"icon\">{{ include('@WebProfiler/Icon/exception.svg') }}</span>
        <strong>Exception</strong>
        {% if collector.hasexception %}
            <span class=\"count\">
                <span>1</span>
            </span>
        {% endif %}
    </span>
{% endblock %}

{% block panel %}
    <h2>Exceptions</h2>

    {% if not collector.hasexception %}
        <div class=\"empty\">
            <p>No exception was thrown and caught during the request.</p>
        </div>
    {% else %}
        <div class=\"sf-reset\">
            {{ render(path('_profiler_exception', { token: token })) }}
        </div>
    {% endif %}
{% endblock %}
", "@WebProfiler/Collector/exception.html.twig", "/Applications/MAMP/htdocs/smallbackendproject/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views/Collector/exception.html.twig");
    }
}
