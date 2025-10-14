# 🎬 Cineripe

O **Cineripe** é um projeto pessoal que simula uma plataforma de **streaming e avaliação de filmes**, inspirado em serviços como Netflix e TMDB.  
Apesar de não reproduzir vídeos do conteúdo, ele oferece funcionalidades completas para **explorar filmes, visualizar detalhes, favoritar e avaliar** produções, consumindo dados reais da **API do TMDB (The Movie Database)**.  

O objetivo do projeto é demonstrar habilidades práticas em **Laravel, PHP e integração com APIs externas**, com uma interface moderna desenvolvida em **Bootstrap**.

---

## 🧠 Sobre o projeto

- Simula uma plataforma de streaming (sem reprodução de vídeo);
- Integra-se à **API pública do TMDB** para exibir informações reais de filmes;
- Permite **login, gerenciamento de favoritos e visualização de detalhes**;
- Desenvolvido em **Laravel (PHP)** e estilizado com **Bootstrap 5**;
- Utiliza **Linux/WSL** para desenvolvimento e versionamento.

---

## 🛠️ Tecnologias utilizadas

- **PHP 8+**
- **Laravel 11**
- **Bootstrap 5**
- **MySQL / MariaDB**
- **TMDB API**

---

## ⚙️ Como rodar o projeto localmente

- Clonar o repositório
```bash
git clone https://github.com/C-Richard-Dev/cineripe.git
cd cineripe

- copiar e colar uma cópia de env.example (renomeando para env) e configurar seu banco de dados e também a sua chave da API do TMDB.

- instalar o composer dentro do diretório principal (composer install)


- rodar migrations + seeders com 'php artisan migrate:fresh --seed'


- rodar servidor local com 'php artisan serve' e em seguida gerar a chave da aplicação. 


- pronto! projeto funcionando.