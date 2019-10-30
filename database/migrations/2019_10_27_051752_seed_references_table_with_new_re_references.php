<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedReferencesTableWithNewReReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('references')->insert([
            ['description' => 'MIURA, N.; KAIYA, H.; SAEKI, M. Building the structure of specification documents from utterances of requirements elicitation meetings. In: Proceedings 1995 Asia Pacific Software Engineering Conference. IEEE, 1995. p. 64-73.'],
            ['description' => 'Marcelo Ribeiro de Almeida (2011) Uma boa reunião: como e quando fazer, Disponível em: https://www.profissionaisti.com.br/2011/11/uma-boa-reuniao-como-e-quando-fazer/ (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'YUSOP, N.; MEHBOOB, Z.; ZOWGHI, D. The role of conducting stakeholder meetings in requirements engineering training. Proc. of REET, v. 7, p. 48-55, 2007.'],
            ['description' => 'CIBOTTO, R. A. G. (2010). A importância do planejamento de reuniões virtuais para o desenvolvimento distribuído de software. V Encontro de Produção Científica e Tecnológica.'],
            ['description' => 'GALL, M.; BERENBACH, B. Towards a framework for real time requirements elicitation. In: 2006 First International Workshop on Multimedia Requirements Engineering (MERE 06-RE 06 Workshop). IEEE, 2006. p. 4-4.'],
            ['description' => 'Maria Perpétua (2018) 10 Excelentes motivos pra você fazer reuniões, Disponível em: https://alusolda.com.br/10-excelentes-motivos-pra-voce-fazer-reunioes/ (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'Laura Montini (2014) What Unproductive Meetings Are Costing You (Infographic), Disponível em: https://www.inc.com/laura-montini/infographic/the-ugly-truth-about-meetings.html (Acessado: 24 de Outubro).'],
            ['description' => 'CARVALHO, Lorena Adrian Cardoso; BARBOSA, Marcelo Werneck; SILVA, Vinícius Bernardo. Proposta e avaliação de uma abordagem lúdica para o ensino de Histórias de Usuário e Scrum. Revista de Gestão e Projetos-GeP, v. 5, n. 3, p. 44-58, 2014.'],
            ['description' => 'Desconhecido (2019) Agile Glossary and Terminology, Disponível em: https://www.agilealliance.org/glossary/user-stories/ (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'Francilvio Alff (2018) Como escrever uma User Story fantástica, Disponível em: https://analisederequisitos.com.br/como-escrever-user-story-fantastica/ (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'COHN, Mike. User stories applied: For agile software development. Addison-Wesley Professional, 2004.'],
            ['description' => 'COCKBURN, Alistair. Writing effective use cases. Addison-Wesley Professional, 2000.'],
            ['description' => 'FIRESMITH, Donald G. Use cases: the pros and cons. Wisdom of the Gurus: A Vision for Object Technology, p. 171-180, 1996.'],
            ['description' => 'Anderson Felipe (2018) Design Thinking Assistant for Requirements Elicitation, Disponível em: https://sites.google.com/site/dta4re/tecnicas-de-design-thinking/personas (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'SCHNEIDEWIND, Lydia et al. How personas support requirements engineering. In: 2012 First International Workshop on Usability and Accessibility Focused Requirements Engineering (UsARE). IEEE, 2012. p. 1-5.'],
            ['description' => 'Anderson Felipe (2018) Design Thinking Assistant for Requirements Elicitation, Disponível em: https://sites.google.com/site/dta4re/tecnicas-de-design-thinking/storyboard (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'WAHID, Shahtab et al. Picking up artifacts: Storyboarding as a gateway to reuse. In: IFIP Conference on Human-Computer Interaction. Springer, Berlin, Heidelberg, 2009. p. 528-541.'],
            ['description' => 'SUTHERLAND, Malcolm; MAIDEN, Neil. Storyboarding requirements. IEEE software, v. 27, n. 6, p. 9-11, 2010.'],
            ['description' => 'VIANNA, Mauricio. Design thinking: inovação em negócios. Design Thinking, 2012.'],
            ['description' => 'Paula Macedo (2016) Mapeando a jornada e a experiência do usuário, Disponível em: https://brasil.uxdesign.cc/mapeando-a-jornada-e-a-experi%C3%AAncia-do-usu%C3%A1rio-49d2c921cbf (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'Anderson Felipe (2018) Design Thinking Assistant for Requirements Elicitation, Disponível em: https://sites.google.com/site/dta4re/tecnicas-de-design-thinking/customer-journey-map (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'Kate Kaplan (2016) When and How to Create Customer Journey Maps,  Disponível em: https://www.nngroup.com/articles/customer-journey-mapping/ (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'Desconhecido (2017) Usability Testing,  Disponível em: https://www.usability.gov/how-to-and-tools/methods/usability-testing.html# (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'Elisa Volpato (2014) Teste de usabilidade: o que é e para que serve?, Disponível em: https://brasil.uxdesign.cc/teste-de-usabilidade-o-que-%C3%A9-e-para-que-serve-de3622e4298b (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'BOWEN, Glenn A. Document analysis as a qualitative research method. Qualitative research journal, v. 9, n. 2, p. 27-40, 2009.'],
            ['description' => 'Elton R. Vieira (2014) Guia de criatividade para projetos de desenvolvimento de software, Disponível em: https://sites.google.com/site/guiadecriatividade/59---focus-group (Acessado: 23 de Outubro de 2019).'],
            ['description' => 'GOMES, Maria Elasir S.; BARBOSA, Eduardo F. A técnica de grupos focais para obtenção de dados qualitativos. Revista Educativa, p. 1-7, 1999.'],
            ['description' => 'SILVA, Isabel Soares; VELOSO, Ana Luísa; KEATING, José Bernardo. Focus group: Considerações teóricas e metodológicas. Revista Lusófona de Educação, n. 26, p. 175-190, 2014.'],
            ['description' => 'GOTTESDIENER, Ellen. Requirements by collaboration: workshops for defining needs. Addison-Wesley Professional, 2002.'],
            ['description' => 'Anderson Felipe (2018) Design Thinking Assistant for Requirements Elicitation, Disponível em: https://sites.google.com/site/dta4re/tecnicas-de-design-thinking/mapa-mental (Acessado: 23 de Outubro de 2019).'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('references')->delete();
    }
}
