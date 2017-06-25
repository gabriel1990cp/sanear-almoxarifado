<body>
<!-- ============ NAV =================== -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div>
                <a class="navbar-brand" href="<?php echo base_url('home') ?>">
                    <img src="<?php echo base_url('images/logo.png'); ?>">
                </a>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo base_url('home') ?>">Home</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Estoque<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url('estoque-entrada') ?>">Entrada</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Equipes <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url('equipes') ?>">Listar</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('cadastrar-equipe') ?>">Cadastrar</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Funcionários<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= base_url('funcionario') ?>">Listar</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('cadastrar-funcionario') ?>">Cadastrar</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuários<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= base_url('usuarios') ?>">Listar</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('cadastrar-usuario') ?>">Cadastrar</a>
                        </li>
                    </ul>
                </li>
                <!--                <li class="dropdown">-->
                <!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatório <b class="caret"></b></a>-->
                <!--                    <ul class="dropdown-menu">-->
                <!--                        <li>-->
                <!--                            <a href="--><?php //echo base_url('relatorio/pedido') ?><!--">Pedidos</a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url('login/encerrar_session') ?><!--">Sair</a>-->
                <!--                </li>-->
            </ul>
        </div>
    </div>
</nav>
<!-- ============ NAV =================== -->