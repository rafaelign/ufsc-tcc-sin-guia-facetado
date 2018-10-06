<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedReferencesTableWithReReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('references')->insert([
            ['description' => 'HANSEN, S.; BERENTE, N.; AVITAL, M. A first step toward innovative projects: An appreciative approach to requirements elicitation. Citeseer, 10 2014.'],
            ['description' => 'ISABIRYE, N.; FLOWERDAY, S. A model for eliciting user requirements specific to south african rural areas. In: ACM.Proceedings of the 2008 annual research conference of the South African Institute of Computer Scientists and Information Technologists on IT research in developing countries: riding the wave of technology.New York, NY, USA: ACM, 2008. (SAICSIT ’08), p. 124–130. ISBN 978-1-60558-286-3.<http://doi.acm.org/10.1145/1456659.1456674>.'],
            ['description' => 'MRAYAT, O. I. A.; NORWAWI, N.; BASIR, N. Requirements elicitation techniques:comparative study.International Journal of Recent Development in Engineering and Technology, v. 1, n. 3, p. 1–10, 2013.'],
            ['description' => 'YOUSEF, R.; ALMARABEH, T. An enhanced requirements elicitation framework based on business process models.Scientific Research and Essays, Academic Journals, v. 10,n. 7, p. 279–286, 2015.'],
            ['description' => 'ZOWGHI, D.; COULIN, C. Requirements elicitation: A survey of techniques, approaches,and tools. In:Engineering and managing software requirements. [S.l.]: Springer, 2005. p.19–46.'],
            ['description' => 'DAVIS, G. "Strategies for Information Requirements Determination," IBM Systems Journal (21:1) 1982, pp 4-30.'],
            ['description' => 'GOGUEN, J., and LINDE, C. "Techniques for Requirements Elicitation," Requirements Engineering (93) 1993, pp 152-164.'],
            ['description' => 'KHAN, K. et al. Requirement development life cycle: The industry practices. In:IEEE.Software Engineering Research, Management and Applications (SERA), 2011 9th International Conference on. [S.l.], 2011. p. 12–16.'],
            ['description' => 'ABBASI, M. A. et al. Assessment of requirement elicitation tools and techniques by various parameters.Software Engineering, v. 3, n. 2, p. 7–11, 2015.'],
            ['description' => 'WRIGHT, G., and AYTON, P. "Eliciting and modelling expert knowledge," Decision Support Systems (3:1) 1987, pp 13-26.'],
            ['description' => 'REHMAN, T. ur; KHAN, M. N. A.; RIAZ, N. Analysis of requirement engineering processes, tools/techniques and methodologies. International Journal of Information Technology and Computer Science (IJITCS), v. 5, n. 3, p. 40, 2013.'],
            ['description' => 'DRISCOLL, L. “Introduction to Primary Research: Interviews Introduction to Primary Research: Observations, Surveys, and Interviews,” vol. 2, 2011.'],
            ['description' => 'POHL, Klaus. Requirements engineering: fundamentals, principles, and techniques. Springer Publishing Company, Incorporated, 2010.'],
            ['description' => 'YOUSUF, M.; ASGER, M. Comparison of various requirements elicitation techniques.International Journal of Computer Applications, Foundation of Computer Science,v. 116, n. 4, 2015.'],
            ['description' => 'SHARMA, S.; PANDEY, S. Revisiting requirements elicitation techniques. International Journal of Computer Applications, Foundation of Computer Science, v. 75, n. 12, 2013.'],
            ['description' => 'ZHANG, Y. and WILDEMUTH, B. M. 2009. Unstructured Interviews,1-9.pp.1-9.  Last Retrieved on July 20, 2013. https://www.ischool.utexas.edu/~yanz/Unstructured_interviews.pdf'],
            ['description' => 'INAYAT, I. et al. A systematic literature review on agile requirements engineering practices and challenges. Computers in human behavior, Elsevier, v. 51, p. 915–929, 2015. ISSN 0747-5632.'],
            ['description' => 'TOMAYKO, J. E. (2002). Engineering of unstable requirements using agile methods. In Proceedings of the international workshop on time constrained requirements engineering.'],
            ['description' => 'SHARMA, S.; PANDEY, S. Requirements elicitation: Issues and challenges. In: IEEE. Computing for Sustainable Global Development (INDIACom), 2014 International Conference on. [S.l.], 2014. p. 151–155.'],
            ['description' => 'ARIF, Q. K. Shams-ul; GAHYYUR, S. Requirements engineering processes, tools/technologies, & methodologies. International Journal of Reviews in Computing, p. 41–56, 2009.'],
            ['description' => 'DAVIS, A. Article in an edited book, Operational Prototyping: A New Development Approach. Software, 9(5): 70-78, 1992.'],
            ['description' => 'LAUESEN, S. , Article in an edited book, Software requirement: Survey of elicitation techniques, pp. 347-358, 2004.'],
            ['description' => 'KHAN, S.; DULLOO, A. B.; VERMA, M. Systematic review of requirement elicitation techniques. [S.l.]: India, 2014.'],
            ['description' => 'DIESTE, O.; JURISTO, N.; SHULL, F. Understanding the customer: what do we know about requirements elicitation? IEEE Software, IEEE, v. 25, n. 2, p. 11–13, March 2008. ISSN 0740-7459.'],
            ['description' => 'SADIQ, M.; GHAFIR, S.; SHAHID, M. An approach for eliciting software requirements and its prioritization using analytic hierarchy process. In: IEEE. Advances in Recent Technologies in Communication and Computing, 2009. ARTCom’09. International Conference on. [S.l.], 2009. p. 790–795.'],
            ['description' => 'NIJEM, Q. Software requirements elicitation tools for service oriented architecture: Comparative analysis. International Journal of Computing Academic Research (IJCAR) ISSN, Citeseer, p. 2305–9184, 2013.'],
            ['description' => 'MULLA, N. Comparison of various elicitation techniques and requirement prioritisationtechniques.International Journal of Engineering Research & Technology (IJERT), v. 1,n. 3, p. 8, 2012.'],
            ['description' => 'SOMMERVILLE, I.Engenharia de software. Tradução Ivan Bosnic e Kalinka G. deO. Gonçalves; revisão técnica Kechi Hirama–. [S.l.]: São Paulo: Pearson Prentice Hall,2011.'],
            ['description' => 'GUNDA, Sai Ganesh. "Requirements engineering: elicitation techniques." (2008).'],
            ['description' => 'TIWARI, SAURABH, RATHORE, Santosh Singh, and GUPTA, Atul. "Selecting requirement elicitation techniques for software projects." Software Engineering (CONSEG), 2012 CSI Sixth International Conference on. IEEE, 2012.'],
            ['description' => 'VIANNA, Mauricio; VIANNA, Ysmar; ADLER, Isabel; LUCENA, Brenda; RUSSO, Beatriz. Design Thinking: inovação em negócios. Rio de Janeiro: MJV Press, 2012'],
            ['description' => 'SOUZA, A. F. et al.Design Thinking Assistant for Requirements Elicitation - DTA4RE.2018.<https://sites.google.com/site/dta4re>. Acessado em 26/09/2018.'],
            ['description' => 'HANINGTON, B., & MARTIN, B. (2012). Universal methods of design: 100 ways to research complex problems, develop innovative ideas, and design effective solutions. Rockport Publishers.'],
            ['description' => 'BARBOSA, S., & SILVA, B. (2010). Interação humano-computador. Elsevier Brasil.'],
            ['description' => 'SPENCER, Donna; WARFEL, Todd. Card sorting: a definitive guide. Publicado em 7 de abril de 2004 no endereço http://boxesandarrows.com/card-sorting-a-definitive-guide, acessado em 28 de novembro de 2018.'],
            ['description' => 'MEAD, Nancy. Requirements Elicitation Case Studies Using IBIS, JAD, and ARM. 2006.'],
            ['description' => 'DUGGAN, E.W. & THACHENKARY, C.S. Information Technology and Management (2003) 4: 391. https://doi.org/10.1023/A:1025134318528'],
            ['description' => 'OWEN, Stephen; BUDGEN, David; BRERETON, Pearl. Protocol Analysis: A neglected Practice. Communications of the ACM. February 2006/Vol.49. No. 2. pages 117-122.'],
            ['description' => 'HAWLEY, Michael. Laddering: A Research Interview Technique for Uncovering Core Values. Publicado em 7 de julho de 2009 no endereço https://www.uxmatters.com/mt/archives/2009/07/laddering-a-research-interview-technique-for-uncovering-core-values.php, acessado em 28 de novembro de 2018.'],
            ['description' => 'CURTIS, Aaron Mosiah et al. An overview and tutorial of the repertory grid technique in information systems research. 2008.'],
            ['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N. Systematizing requirements elicitation technique selection. Information and Software Technology, Elsevier, v. 56, n. 6, p.644–669, 2014. ISSN 0950-5849.'],
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
