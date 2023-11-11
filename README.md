# atividade-clube-do-valor
1. Objetivo: Este teste fornece uma idéia da complexidade da posição, por isso, não aconselhamos o uso do GPT-4, tendo em vista que, caso você avance, vamos explorar o teste e compreender a sua real expertise técnica. Esperamos que o profissional que assuma a posição tenha o conhecimento técnico para resolver esse tipo de desafio no dia a dia já no início de sua jornada conosco. 
2. Case: João quer mapear a utilização de um botão no seu site WordPress. A cada clique no botão ele quer adicionar um registro no banco de dados e verificar posteriormente o volume de cliques realizados.
3. Desafio: Para esse teste você irá criar 2 plugins WordPress separados

**A) Crie um plugin que adicione um shortcode ou widget customizado ao site. Esse shortcode/widget deverá mostrar um botão na página que, quando clicado, adicionar um registro de data e hora no banco de dados wordpress. A tabela utilizada para guardar esse registro fica à sua escolha.**

**B) Crie um plugin que adicione um comando ao WP-CLI que imprima um relatório de histórico de registros. Esse relatório pode ser apenas a listagem das últimas entradas com seus respectivos.**

==================================================================================
##                                                    
<!--
                         _      __           _   _         
                        | |    / _|         | | (_)        
  _ __     ___    _ __  | |_  | |_    ___   | |  _    ___  
 | '_ \   / _ \  | '__| | __| |  _|  / _ \  | | | |  / _ \ 
 | |_) | | (_) | | |    | |_  | |   | (_) | | | | | | (_) |
 | .__/   \___/  |_|     \__| |_|    \___/  |_| |_|  \___/ 
 | |                                                       
 |_|                                                       

  _           _          _       _   _      _   _                            
 | |         (_)        | |     (_) | |    (_) | |                           
 | |_         _    ___  | |__    _  | | __  _  | |__     __ _   _ __    __ _ 
 | __|       | |  / __| | '_ \  | | | |/ / | | | '_ \   / _` | | '__|  / _` |
 | |_   _    | | | (__  | | | | | | |   <  | | | | | | | (_| | | |    | (_| |
  \__| (_)   |_|  \___| |_| |_| |_| |_|\_\ |_| |_| |_|  \__,_| |_|     \__,_|
                                                                             


-->

**Link do repositório no Github:**
https://github.com/takashi-ichikihara/atividade-clube-do-valor/ 

**Plugin A:**
Shortcode para inserir o botão [botao_registro]

**Plugin B:**
Shortcode [display_click_table] > Mostrar os dados da tabela
Shortcode para inserir o botão  [display_click_table]

Linha de comando do WP-CLI no terminal: Vai retornar as últimas 10 entradas da tabela de cliques mostrando ID, DataHora e Cliques
# **wp click-tracking report** #
##
==================================================================================

# PLUGIN A
## 1) Primeiro vamos criar um diretório para o plugin
Chamei a pasta de auto-click
###
<img src='/images/ativ1.jpg'>

## 2) Criar um arquivo em php dentro da pasta auto-click com nome click-recorder.php
## 3) Ativar o plugin
###
<img src='/images/ativ1a.jpg'>

## Adicionando o shortcode dentro do conteúdo da página do site
Para exibir dentro da página coloque o shortcode [botao_registro]
###
<img src='/images/ativ2.jpg'>

**Testando o clique do botão e mostrando o acesso a cada clique como ele salva no banco de dados pegando o ID e DATA_HORA**
###
<img src='/images/ativ3.jpg'>

# PLUGIN B

## **Quebrando o problema em 6 partes**

## 1) Vamos criar diretorio do plugin **Registro de cliques**

###
<img src='/images/ativ01.jpg'>

## 2) Fazer com que o clique do botão armazena os dados na tabela em sql ##

###
<img src='/images/ativ02.jpg'>

## 3) Agora Print os Dados da Tabela do banco em uma tabela num post no wordpress##
###
<img src='/images/ativ03.jpg'>

## 4) Mostrar botão e a tabela no Post no Wordpress o shortcode para mostrar o botão é [click_button] ##
###

## 5) **Adicionar um comando ao WP-CLI que imprima um relatório de histórico de registros com as linhas ID, DataHora e Cliques.**##
<img src='/images/ativ04.jpg'>



###
## 6) Acrescentei um botão de Excluir um registro da tabela no banco e na tabela do post
<img src='/images/ativ05.jpg'>
