# Exercício 6 - Sistema de Gestão e Orçamento de Projetos

Este projeto é uma aplicação web em PHP desenvolvida como parte das atividades práticas da unidade curricular de **Programação Web II** do Curso Técnico em Desenvolvimento de Sistemas (IFSC - Câmpus Florianópolis). 

## 🎯 Finalidade do Projeto
A finalidade principal deste projeto foi consolidar e pôr em prática conceitos fundamentais de desenvolvimento web backend, padrões de arquitetura de software, segurança em consultas e gerenciamento robusto de banco de dados utilizando PHP estruturado.

---

## 🏗️ Arquitetura Utilizada
O sistema foi inteiramente construído seguindo o padrão arquitetural **MVC (Model-View-Controller)**, garantindo uma separação clara de responsabilidades:

- **Model (Modelo):** Contém as regras de negócio e a representação dos dados na classe de domínio (`Projeto.php`), além da abstração da persistência através do padrão DAO (`ProjetoDAO.php`).
- **View (Visão):** Interface gráfica simplificada e minimalista (`Index.php`) responsável por renderizar os formulários de entrada e apresentar os resultados tabulares de forma limpa.
- **Controller (Controlador):** O maestro do fluxo da aplicação (`ProjetoController.php`), que recebe as requisições do usuário, aciona os métodos adequados do modelo e dita o destino da navegação.

---

## 💡 Conceitos Aplicados

1. **MySQLi com Prepared Statements:** Toda a comunicação com o banco de dados utiliza declarações preparadas (`prepare` e `bind_param`), blindando a aplicação contra ataques de *SQL Injection* e padronizando a tipagem dos dados inseridos.
2. **Conexão Autônoma (Failsafe Interceptor):** A classe de conexão possui uma lógica automatizada capaz de interceptar exceções (como o erro `1049` de banco desconhecido). Se o banco de dados não existir no ambiente local, o próprio sistema cria a estrutura (`CREATE DATABASE` e `CREATE TABLE`) em segundo plano de forma invisível para o usuário.
3. **Padrão PRG (Post/Redirect/Get) via Sessões:** Para contornar problemas comuns em arquiteturas MVC (como a perda de caminhos relativos de arquivos CSS e o reenvio acidental de formulários ao atualizar a página com F5), as respostas do banco são armazenadas temporariamente na superglobal `$_SESSION` do PHP, seguidas por um redirecionamento limpo via cabeçalho (`header`).
4. **Manipulação de Consultas Agregadas e Linhas Afetadas:** Implementação de lógica para extração de arrays associativos (`fetch_assoc`), contagem condicional utilizando filtros temporais (`COUNT(*)`) e validação de exclusões reais através da propriedade `affected_rows` do MySQLi.

---

## 🛠️ Tecnologias e Ferramentas
- **Linguagem Backend:** PHP 8.x
- **Banco de Dados:** MySQL / MariaDB
- **Frontend:** HTML5 e CSS3 (Design Simétrico/Minimalista)
