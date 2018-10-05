<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithJad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = DB::table('users')
            ->select(['id'])
            ->where('email', 'admin@mailinator.com')
            ->first();

        $RETechniqueClassification= DB::table('classifications')
            ->select(['id', 'title'])
            ->where('slug', str_slug('Técnicas de Elicitação de Requisitos'))
            ->first();

        $description = 'Joint Application Development (JAD) é uma das técnicas mais utilizadas na indústria, utilizada para elicitar requisitos funcionais e não funcionais. Foi originalmente desenvolvida para uso interno da IBM. São workshops colaborativos que duram de quatro a cinco dias que resultam em um conjunto de requisitos de usuário. Ajuda a coletar muita informação em um período curto. Seu planejamento antecipado é obrigatório para estas sessões, incluindo a presença dos participantes chave. Os participantes compartilham suas opiniões sobre o que precisa ser feito e o que precisa mudar. Todas as sessões são gravadas. Em alguns casos, um protótipo pode ser um dos produtos gerados durante uma sessão. É uma técnica usada para desenvolvimento de novos produtos e para projetos de melhoria. O objetivo é envolver todos stakeholders no processo de planejamento do produto, através de reuniões altamente estruturadas. Tipicamente tem os seguintes participantes: Facilitador, Usuário, principais desenvolvedores e observadores. É similar à técnica Brainstorm, exceto pelo fato de que os stakeholders estão envolvidos na discussão sobre o sistema. A variedade de participantes de uma sessão é muito importante, pois promove uma discussão mais ampla acerca do sistema. A técnica JAD contém 5 fases distintas:

**Definição do projeto**

- Determinar o propósito, escopo e objetivos do sistema.
- Identificar os participantes.
- Estabelecer o cronograma.

**Pesquisa**

- Coletar informações detalhadas sobre os requisitos de usuários.
- Explorar as implicações técnicas, sociais e políticas.
- Considerar questões gerais do sistema, verificação do que precisa ser decidido na sessão.

**Preparação**

- Preparação para a sessão.
- Finalizar a logística para a reunião.
- Adquirir recursos visuais, documentos de trabalho e outros aparatos de reunião.
- Preparar o responsável pelas anotações.

**Sessão JAD**

- Reunir as informações e os conhecimentos dos membros da equipe do JAD na análise de solução potencial.
- Gerar soluções (requisitos de sistemas) durante o período da sessão.
- Finalizar e documentar as decisões da reunião.

**Documento final**

- Preparar o documento final com as decisões e acordos identificados durante o workshop.

## Exemplo

Neste exemplo, a equipe decidiu combinar as duas primeiras etapas da técnica JAD, entrevistando os stakeholders com base em uma série de questões:

- Qual o propósito do projeto?
- Qual seu escopo?
- Quais são as metas gerenciais e de segurança?
- Quais são as funcionalidades, restrições, premissas e problemas do projeto?
- Quem são os usuários?
- Qual é o fluxo de trabalho?


Neste exemplo, a equipe decidiu não usar nenhum recurso visual na fase de preparação, pois a comunicação com os stakeholder era principalmente via teleconferência.Como a técnica é focada no usuário e neste caso existiam algumas questões a tratar sobre a segurança de determinados requisitos, a equipe decidiu não repassar o fluxo de trabalho, os elementos de dados, telas e relatórios de etapas na fase. Portanto, o único passo restante foi discutir questões em aberto sobre a plataforma. Inicialmente os stakeholders levantaram os seguintes problemas em aberto (alguns exemplos):

- Como será fornecido a alta disponibilidade?
- Na camada da Web?
- Na camada do banco de dados?
- Como será tratado o controle de versão?
- Quais são os métodos de teste?
- Por que você está considerando a camada de soquetes seguros (SSL) para autenticar os usuários?
- Quais são os melhores procedimentos para garantir que essas ações sejam registradas?
- Como você vai gerenciar usuários e autorização?
- 100% de tempo de atividade é necessário para o projeto?
- Como a integridade do site deve ser protegida?

Através desta sessão a equipe define determinados requisitos que são relevantes para a situação apresentada, neste exemplo foram levantados requisitos relacionados a segurança:

- O sistema deve fornecer informações confiáveis para os usuários que têm acesso.
- O sistema deve garantir que apenas usuários autenticados possam acessar o conteúdo protegido.
- O sistema deve garantir a integridade do conteúdo que é fornecido aos usuários usando autenticação, autorização e controle de acesso.
- O sistema deve habilitar o controle de versão tanto no conteúdo apresentado quanto no desenvolvimento da plataforma.

![Exemplo JAD](/images/tecnicas-re/jad-01.png)

<sup>[2] [3] [4] [6] [7] [8] [9]</sup>';

        $pros = '- Diminui o tempo e o custo do processo de elicitação de requisitos.
- Acelera o projeto do sistema.
- Estimula a geração de novas ideias para saídas criativas.
- Promove o feedback do usuário.
- Aumenta a satisfação dos usuários.
- Melhora a comunicação entre os stakeholders, analistas e demais profissionais.
- Recursos visuais e ferramentas usadas tornam as sessões interativas.
- Fornece uma abordagem estruturada bem formatada.
- Promove mudanças rápidas nos requisitos.

<sup>[3] [5]</sup>';

        $cons = '- Se não for devidamente planejada ou se muitos stakeholders estiverem envolvidos, pode resultar em um desperdício de tempo e recursos.
- Requer facilitadores treinados.
- Requer muito planejamento e esforço.
- É uma técnica cara.
- Requer uma equipe com enorme experiência e especialização no domínio do problema.
- Se a quantidade de sessões é alta, os usuários tendem a inferir que o desenvolvedor está transferindo a responsabilidade do projeto para eles.

<sup>[1] [3] [5] [6]</sup>';

        DB::table('entities')->insert([
            'title'             => 'JAD',
            'slug'              => str_slug($RETechniqueClassification->title . ' JAD'),
            'short_description' => 'Criada pela IBM, a Joint Application Development (JAD) é usada para capturar requisitos funcionais e não funcionais.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => $user->id,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $technique = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' JAD'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Grupo',
            'Fonte principal' => 'Analistas e Stakeholders',
            'Tipo de técnica' => 'Direta',
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Baixo',
            'Pessoas por sessão' => 'Em massa',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Superior',
            'Definição do problema' => 'Baixo',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($technique->id, [
            'Experiência com técnicas de elicitação' => 'Alto',
            'Familiaridade com o domínio' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Alto',
            'Tipo de informação a elicitar' => 'Estratégica',
        ]);

        $this->values($technique->id, [
            'Especialidade' => 'Especialista',
        ]);

        $this->references($technique->id, [
            [
                'description' => 'YOUSEF, R.; ALMARABEH, T',
                'code' => 1
            ],
            [
                'description' => 'KHAN, K. et al. Requirement development',
                'code' => 2
            ],
            [
                'description' => 'YOUSUF, M.; ASGER, M. Comparison',
                'code' => 3
            ],
            [
                'description' => 'SHARMA, S.; PANDEY, S. Revisiting requirements',
                'code' => 4
            ],
            [
                'description' => 'ARIF, Q. K. Shams-ul; GAHYYUR, S. Requirements',
                'code' => 5
            ],
            [
                'description' => 'SADIQ, M.; GHAFIR, S.; SHAHID, M. An',
                'code' => 6
            ],
            [
                'description' => 'MULLA, N. Comparison of various elicitation',
                'code' => 7
            ],
            [
                'description' => 'MEAD, Nancy. Requirements Elicitation Case',
                'code' => 8
            ],
            [
                'description' => 'DUGGAN, E.W. & THACHENKARY, C.S. Information',
                'code' => 9
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos JAD')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos JAD')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos JAD')]);
    }

    private function values(int $interviewId, array $facetsWithValues)
    {
        foreach ($facetsWithValues as $facet => $value) {
            $facetValues = DB::table('values')
                ->select(['id', 'facet_id'])
                ->where('slug', str_slug($facet . ' ' . $value))
                ->first();

            DB::table('entities_values')->insert([
                'entity_id' => $interviewId,
                'value_id' => $facetValues->id,
            ]);
        }
    }

    private function references(int $interviewId, array $referencesWithValues)
    {
        foreach ($referencesWithValues as $reference) {
            $getReference = DB::table('references')
                ->select(['id'])
                ->where('description', 'like', trim($reference['description'] . '%'))
                ->first();

            DB::table('entities_references')->insert([
                'entity_id' => $interviewId,
                'reference_id' => $getReference->id,
                'code' => (int) $reference['code'],
            ]);
        }
    }
}
