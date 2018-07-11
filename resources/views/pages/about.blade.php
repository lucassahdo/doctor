@extends('layout.base') @section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h3>> Desafio MAZZA</h3>
                    <p>
                        Projeto proposto pela MAZZA como teste de conhecimento do framework Laravel. O objetivo do projeto é fornecer um ambiente
                        crud para genrenciamento de pessoas consultas médicas e gestão de pessoas.
                    </p>

                    <br>
                    <h3>> Tech Stack do projeto</h3>
                    <h4>- Frontend:</h4>
                    <p>1. Javascript</p>
                    <p>2. Jquery</p>
                    <p>3. HTML5</p>
                    <p>4. CSS3</p>
                    <p>5. Pré-processador SASS</p>
                    <p>6. Gulp</p>

                    <h4>- Backend:</h4>
                    <p>1. PHP 7.0 com o framework Laravel 5.5</p>
                    <p>2. Mysql</p>
                    <p>3. Nginx</p>
                    <p>4. Digital Ocean - Ubuntu 16.04</p>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>> Links</h3>
                            <button class="btn btn-github" onclick="window.open('https://github.com/lucassahdo/doctor','_blank')">
                                <i class="fab fa-github"></i> Código fonte no Github
                            </button>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-success" onclick="window.open('http://sahdo.me','_blank')">
                                <i class="fa fa-rocket"></i> Website Lucas Sahdo
                            </button>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-linkedin" onclick="window.open('https://www.linkedin.com/in/lucassahdo','_blank')">
                            <i class="fab fa-linkedin"></i> Linkedin Lucas Sahdo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection