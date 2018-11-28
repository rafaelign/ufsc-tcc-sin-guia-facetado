# Guia utilizando uma classificação facetada

Aplicação desenvolvida na conclusão da graduação em Sistemas de Informação - UFSC

Esta aplicação é composta por uma camada backend em Laravel PHP que contempla uma API e um painel administrativo e por uma camada frontend em VueJS onde é apresentado o Guia desenvolvido. Seguem abaixo alguns comandos utilizados no processo de desenvolvimento e publicação da ferramenta.

Instalação/atualização de dependências PHP

```
./composer.phar install
ou
./composer.phar update
``` 

Instalação de dependências Javascript

```js
npm install --save
```

Aplicação de alterações da base de dados:

```
php artisan migrate
```

Build da aplicação frontend do Guia e do Painel administrativo:
``` 
npm run prod
```

O repositório ainda consta com uma receita Docker para subir o ambiente (docker-compose.yml)