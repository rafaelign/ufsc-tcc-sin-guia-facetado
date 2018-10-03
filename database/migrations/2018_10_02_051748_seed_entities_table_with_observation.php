<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithObservation extends Migration
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

        $description = 'Também é chamada de análise social. Esta técnica é realizada com o envolvimento direto do observador na sociedade. Os observadores incentivam as pessoas a trabalhar com o produto. Os requisitos são coletados conforme a observação desses processos sem a interferência do observador na rotina. Esta técnica é usada quando o cliente não consegue explicar sua necessidade ou como funcionam seus processos. Geralmente é utilizada em conjunto com outras técnicas. Os dados a serem coletados devem ser predefinidos para evitar confusão. Também é utilizado quando os usuários estão muito ocupados para serem envolvidos em entrevistas. A observação ajuda a coletar requisitos implícitos que uma entrevista não consegue revelar. É um tipo de técnica etnográfica. Esta técnica precisa de uma certa sensibilidade e consciência sobre o ambiente em que os usuários estão inseridos.

Pode ser feita das seguintes formas:

- **Ativa**: Neste tipo de abordagem o usuário pode ser questionado durante o processo de observação.
- **Passiva**: Neste tipo de abordagem o observador não pode interagir com o usuário a medida que observa sua rotina.

## Exemplo

Este exemplo foi utilizado pelo autor para retratar uma técnica chamada etnografia rápida, porém ele também se encaixa com a técnica de observação.

> Sara é analista de sistemas e seu gerente lhe passou um problema de um cliente que tem como objetivo desenvolver um sistema de fila eletrônica de uma clínica médica. Atualmente, o agendamento de consultas é realizado por telefone ou pessoalmente. Essas informações são armazenadas em uma planilha eletrônica. Sara e mais um membro de sua equipe **foram ao local** durante dois dias úteis não seguidos. Um dia era o que, segundo a atendente, era o mais movimentado e o outro dia, menos movimentado. Sara e o membro de sua equipe ficaram por esses dois dias na clínica durante o horário comercial. Eles **registraram informações referentes a, por exemplo, quantidade de pacientes em espera, quais eram pacientes do grupo especial (gestantes, idosos e deficientes) e tempo de consulta para cada atendimento realizado pelos médicos da clínica**. Eventualmente, Sara selecionava alguns pacientes para fazer uma **pequena entrevista** sobre a clínica e o seu atendimento. Passados os dias de **observação em campo**, Sara e o membro de sua equipe **reuniram informações a partir dos dados que eles registraram e das entrevistas realizadas** por Sara para definição dos requisitos do sistema.

<sup>[4] [9] [14] [19] [20] [33]</sup>';

        $pros = '- Confiável por ser uma levantamento feito pelo próprio analista.
- Pode ser útil para validar requisitos levantados por outros métodos.
- É um método barato.
- Dá uma ideia de como os usuários interagem com o sistema.
- Ajuda a mensurar quão particular as tarefas são para a empresa.

<sup>[14]</sup>';

        $cons = '- É necessário fazer múltiplas sessões para cobrir todos requisitos.
- Os usuários podem se comportar com indiferença quando interrompidos para responder perguntas em uma observação direta.
- Na observação passiva, é difícil para o analista entender por que algumas decisões são tomadas.
- A aplicação desta técnica é demorada.
- Difícil de elicitar requisitos se envolver trabalho intelectual ou se for algo difícil de observar.
- As viagens pode elevar o custo da técnica.

<sup>[4] [14] [21]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Observação direta',
            'slug'              => str_slug($RETechniqueClassification->title . ' Observação direta'),
            'short_description' => 'Esta técnica é realizada com o envolvimento direto do observador na sociedade. Os observadores incentivam as pessoas a trabalhar com o produto enquanto os requisitos são coletados através da observação desses processos.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => $user->id,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $interview = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Observação direta'))
            ->first();

        $this->values($interview->id, [
            'Categoria' => 'Cognitiva',
            'Fonte principal' => 'Observador',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Baixo',
            'Experiência com técnicas de elicitação' => 'Nenhum',
            'Familiaridade com o domínio' => 'Nenhum',
            'Pessoas por sessão' => 'Individual',
            'Interesse do stakeholder' => 'Nenhum',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Baixo',
            'Disponibilidade de tempo' => 'Baixo',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Nenhum',
            'Definição do problema' => 'Baixo',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($interview->id, [
            'Pessoas por sessão' => 'Grupo',
            'Especialidade' => 'Bem informado',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
        ]);

        $this->values($interview->id, [
            'Nível de informação disponível' => 'Superior',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Observação direta')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Observação direta')]);
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
}
