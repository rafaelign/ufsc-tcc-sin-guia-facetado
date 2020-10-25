<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithPrototyping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $RETechniqueClassification= DB::table('classifications')
            ->select(['id', 'title'])
            ->where('slug', str_slug('Técnicas de Elicitação de Requisitos'))
            ->first();

        $description = 'Prototipação pode ser considerada como a confecção de uma versão inicial do produto, preparada para coletar o feedback das partes interessadas e levantar alterações que devem ser incorporadas na próxima edição. O uso de protótipos é muito útil quando os stakeholders não tem muita familiaridade com as opções tecnológicas disponíveis para atender sua necessidade. Uma visão antecipada do software torna fácil a determinação de ambiguidades ou conflitos nos requisitos. É importante ressaltar que apesar de causar uma sobrecarga, o protótipo diminui as chances de falha da concepção, uma garantia de 80% de seleção dos requisitos apropriados. Desta forma, esta técnica visa descobrir e visualizar os requisitos da interface antes de projetar ou desenvolver o aplicativo. É útil para o desenvolvimento de novos sistemas, principalmente quando a plataforma tem mais interações de usuário do que funcionalidades internas ou quando os stakeholders não estão familiarizados com as soluções disponíveis. Vem sendo bastante utilizada para elicitação onde há muita incerteza nos requisitos ou quando o stakeholder precisa do feedback.

Podem fornecer dois tipos de requisitos:

- **A nível de produto**: Define uma funcionalidade requerida, é realista e útil.
- **A nível de design**: Define como a interface do sistema será apresentada.

Quanto aos tipos de protótipos, para elicitação de requisitos podemos citar:

- **Protótipo em papel**: são representações de interfaces gráficas com diferentes níveis de fidelidade, desde um wireframe desenhado à mão em pequenos pedaços de papel até uma embalagem de sabonete.

- **Protótipo de experiência**: é a simulação da experiência do serviço que prevê alguns de seus desempenhos através do uso de interações específicas envolvidas

## Exemplo

- Exemplo de protótipo em papel.

<iframe width="560" height="315" src="https://www.youtube.com/embed/hB9bt_dmlBQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

- Exemplo de protótipo desenvolvido no Balsamiq.

<iframe width="560" height="315" src="https://www.youtube.com/embed/wEw7zaLCi8s" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

<sup>[2] [3] [4] [5] [6] [7] [10] [11] [14] [15]</sup>';

        DB::table('entities')
            ->where('slug', str_slug($RETechniqueClassification->title . ' Prototipação'))
            ->update([
                'description' => $description,
                'updated_at'  => Carbon::now(),
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
