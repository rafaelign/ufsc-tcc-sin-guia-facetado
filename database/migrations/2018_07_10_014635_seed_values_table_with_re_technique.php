<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedValuesTableWithReTechnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 4 16 21 30
        $data = [
            'Categoria' => [
                [
                    'title' => 'Cognitiva',
                    'value' => 'cognitiva',
                    'description' => 'Tem o objetivo de analisar e coletar informações até o nível do pensamento humano, compreendendo os problemas em profundidade.',
                ],
                [
                    'title' => 'Contextual',
                    'value' => 'contextual',
                    'description' => 'É uma combinação entre entrevista não estruturada, análise do contexto do usuário e prototipagem, afim de coletar dados sobre os procedimentos, ambiente, padrões e fluxo de trabalho.',
                ],
                [
                    'title' => 'Grupo',
                    'value' => 'grupo',
                    'description' => 'São técnicas que envolvem times ou grupos de stakeholders, cada um com sua especialidade a favor de um objetivo.',
                ],
                [
                    'title' => 'Inovadora',
                    'value' => 'inovadora',
                    'description' => 'São técnicas consideradas novas, que procuram resolver lacunas que as outras técnicas deixam.',
                ],
                [
                    'title' => 'Tradicional',
                    'value' => 'tradicional',
                    'description' => 'As técnicas mais antigas e mais comuns são chamadas de tradicionais.',
                ],
            ],
            'Fonte principal' => [
                [
                    'title' => 'Analista com conhecimento no domínio',
                    'value' => 'analista-conhecimento-domínio',
                    'description' => 'Analista que discute sobre o produto com diferentes grupos de pessoas para desenvolver a compreensão do problema.',
                ],
                [
                    'title' => 'Analistas e Stakeholders',
                    'value' => 'analistas-takeholders',
                    'description' => 'Analistas e Stakeholders se comunicam e organizam o conhecimento sobre os requisitos.',
                ],
                [
                    'title' => 'Documentação',
                    'value' => 'documentacao',
                    'description' => 'Leitura da documentação existente ou do próprio sistema em uso.',
                ],
                [
                    'title' => 'Especialista',
                    'value' => 'especialista',
                    'description' => 'Envolve um especialista no conhecimento de domínio para a execução da coleta.',
                ],
                [
                    'title' => 'Facilitador externo',
                    'value' => 'facilitador-externo',
                    'description' => 'Stakeholders se reúnem para criar ou revisar informações de alto nível dos produtos.',
                ],
                [
                    'title' => 'Observador',
                    'value' => 'observador',
                    'description' => 'Um observador analisa uma pessoa ou grupo em seu contexto e coleta informações detalhadas sobre suas práticas.',
                ],
            ],
            'Tipo de técnica' => [
                [
                    'title' => 'Direta',
                    'value' => 'direta',
                    'description' => 'Possui contato direto com os interessados.',
                ],
                [
                    'title' => 'Indireta',
                    'value' => 'indireta',
                    'description' => 'Não possui contato direto com os interessados.',
                ],
            ],
            'Tipo de dado' => [
                [
                    'title' => 'Qualitativo',
                    'value' => 'qualitativo',
                    'description' => 'Possui o foco em aspectos subjetivos, atingindo motivações não explícitas.',
                ],
                [
                    'title' => 'Quantitativo',
                    'value' => 'quantitativo',
                    'description' => 'Procuram apurar características explicitas, onde é possível mensurar os resultados.'
                ],
            ],
            'Comunicação' => [
                [
                    'title' => 'Bidirecional',
                    'value' => 'bidirecional',
                    'description' => 'O fluxo de informação ocorre em ambas as direções.',
                ],
                [
                    'title' => 'Unidirecional',
                    'value' => 'unidirecional',
                    'description' => 'O fluxo de informação só ocorre em uma direção.',
                ],
            ],
            'Treinamento na técnica de elicitação' => [
                [
                    'title' => 'Nenhum',
                    'value' => 'nenhum',
                    'description' => 'Não é necessário.',
                ],
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'Treinamento sem prática',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Treinamento formal e prática',
                ],
            ],
            'Experiência do elicitor' => [
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'Menos de dois projetos de elicitação de requisitos.',
                ],
                [
                    'title' => 'Médio',
                    'value' => 'medio',
                    'description' => 'De dois a cinco projetos de elicitação de requisitos.',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Mais de cinco projetos de elicitação de requisitos.',
                ],
            ],
            'Experiência com técnicas de elicitação' => [
                [
                    'title' => 'Nenhum',
                    'value' => 'nenhum',
                    'description' => 'Nenhuma aplicação de técnica.',
                ],
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'De uma a cinco de técnica.',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Mais de cinco aplicações de técnica.',
                ],
            ],
            'Familiaridade com o domínio' => [
                [
                    'title' => 'Nenhum',
                    'value' => 'nenhum',
                    'description' => 'Não é necessário',
                ],
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'De um a dois projetos ou conhecimento formal.',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Acima de dois projetos ou conhecimento formal.',
                ],
            ],
            'Pessoas por sessão' => [
                [
                    'title' => 'Em massa',
                    'value' => 'em-massa',
                    'description' => 'Mais que cinco pessoas',
                ],
                [
                    'title' => 'Grupo',
                    'value' => 'grupo',
                    'description' => 'De duas a cinco pessoas.',
                ],
                [
                    'title' => 'Individual',
                    'value' => 'individual',
                    'description' => 'Uma pessoa.',
                ],
            ],
            'Consenso entre os stakeholders' => [
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'Sem consenso entre os stakeholders.',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Com consenso entre os stakeholders.',

                ],
            ],
            'Interesse do stakeholder' => [
                [
                    'title' => 'Nenhum',
                    'value' => 'nenhum',
                    'description' => 'Sem interesse.',
                ],
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'Pouco interessado.',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Muito interessado',
                ],
            ],
            'Especialidade' => [
                [
                    'title' => 'Especialista',
                    'value' => 'especialista',
                    'description' => 'Mais de cinco anos de trabalho com o domínio.',
                ],
                [
                    'title' => 'Bem informado',
                    'value' => 'bem-informado',
                    'description' => 'De dois a cinco anos de trabalho com o domínio.',
                ],
                [
                    'title' => 'Iniciante',
                    'value' => 'iniciante',
                    'description' => 'Menos de dois anos de trabalho com o domínio.',
                ],
            ],
            'Articulação' => [
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'Não precisa compartilhar o conhecimento claramente.',
                ],
                [
                    'title' => 'Médio',
                    'value' => 'medio',
                    'description' => 'Precisa compartilhar conhecimento razoavelmente bem.',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Precisa compartilhar o conhecimento muito bem.',
                ],
            ],
            'Disponibilidade de tempo' => [
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'Tem menos tempos que o necessário.',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Tem tempo suficiente.',
                ],
            ],
            'Local/Acessibilidade' => [
                [
                    'title' => 'Longe',
                    'value' => 'longe',
                    'description' => 'Está em um cidade diferente do elicitor.',
                ],
                [
                    'title' => 'Perto',
                    'value' => 'perto',
                    'description' => 'Está na mesma cidade do elicitor.',
                ],
            ],
            'Tipo de informação a elicitar' => [
                [
                    'title' => 'Básica',
                    'value' => 'basica',
                    'description' => 'Coleta informações associadas a conceitos, atributos e elementos.',
                ],
                [
                    'title' => 'Estratégica',
                    'value' => 'estrategica',
                    'description' => 'Coleta informações associadas a estratégia, controle e diretivas.',
                ],
                [
                    'title' => 'Tática',
                    'value' => 'tatica',
                    'description' => 'Coleta informações associadas a processos, funções e heurísticas.',
                ],
            ],
            'Nível de informação disponível' => [
                [
                    'title' => 'Inferior',
                    'value' => 'inferior',
                    'description' => 'Necessita de informações básicas e/ou táticas.',
                ],
                [
                    'title' => 'Nenhum',
                    'value' => 'nenhum',
                    'description' => 'Não é necessário.',
                ],
                [
                    'title' => 'Superior',
                    'value' => 'superior',
                    'description' => 'Necessita de informações táticas e/ou estratégicas.',
                ],
            ],
            'Definição do problema' => [
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'Fracamente definido',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Bem definido',
                ],
            ],
            'Restrição de tempo do projeto' => [
                [
                    'title' => 'Baixo',
                    'value' => 'baixo',
                    'description' => 'Tempo mais que suficiente.',
                ],
                [
                    'title' => 'Médio',
                    'value' => 'medio',
                    'description' => 'Tempo suficiente.',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'alto',
                    'description' => 'Tempo insuficiente.',
                ],
            ],
            'Tempo de processo' => [
                [
                    'title' => 'Início',
                    'value' => 'inicio',
                    'description' => 'Elicitação das definições gerais.',
                ],
                [
                    'title' => 'Meio',
                    'value' => 'meio',
                    'description' => 'Elicitação dos requisitos chave.',
                ],
                [
                    'title' => 'Fim',
                    'value' => 'fim',
                    'description' => 'Elicitação das informações finais.',
                ],
            ],
        ];

        foreach ($data as $facet => $values) {
            $this->create($facet, $values);
        }
    }

    private function getFacetIdByTitle(string $title)
    {
        $facet = DB::table('facets')
            ->select(['id'])
            ->where('slug', 'LIKE', str_slug($title))
            ->first();

        return $facet->id;
    }

    private function create($facetTitle, $values)
    {
        $facetId = $this->getFacetIdByTitle($facetTitle);

        foreach ($values as $value) {
            DB::table('values')->insert(array_merge($value, [
                'facet_id'      => $facetId,
                'slug'          => str_slug($facetTitle . ' ' . $value['title']),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $RETechniqueClassification = DB::table('classifications')
            ->select(['id'])
            ->where('slug', str_slug('Técnicas de Elicitação de Requisitos'))
            ->first();

        $REFacets = DB::table('facets')
            ->select(['id'])
            ->where('classification_id', $RETechniqueClassification->id)
            ->get();

        foreach ($REFacets as $facet) {
            DB::delete('DELETE FROM `values` WHERE facet_id = ?', [$facet->id]);
        }
    }
}
