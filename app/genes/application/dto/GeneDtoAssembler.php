<?php


namespace genes\application\dto;


use yii\base\Exception;

class GeneDtoAssembler implements GeneDtoAssemblerInterface
{
    private static $expressionChangeEn = [
        'уменьшается' => 'decreased',
        'увеличивается' => 'increased',
        'неоднозначно' => 'mixed',
        'не изменяется' => 'not set',
    ];

    public function mapViewDto(array $geneArray, string $lang): GeneFullViewDto
    {
        $geneDto = new GeneFullViewDto();
        $geneCommentsReferenceLinks = [];
        $geneCommentsReferenceLinksSource = explode(',', $geneArray['commentsReferenceLinks']);
        foreach ($geneCommentsReferenceLinksSource as $commentsRef) {
            $commentsRefLink = preg_replace('/^(\s?<br>)?\s*\[[0-9\-]*\s*[[0-9\-]*]\s*/', '', $commentsRef);
            $geneCommentsReferenceLinks[$commentsRefLink] = $commentsRef;
        }
        $geneDto->id = (int)$geneArray['id'];
        $geneDto->origin = $this->prepareOrigin($geneArray);
        $geneDto->symbol = $geneArray['symbol'];
        $geneDto->aliases = explode(' ', $geneArray['aliases']);
        $geneDto->name = $geneArray['name'];
        $geneDto->entrezGene = $geneArray['entrezGene'];
        $geneDto->uniprot = $geneArray['uniprot'];
        $geneDto->commentCause =  explode(',', $geneArray['comment_cause']);
        $geneDto->proteinClasses =  explode('||', $geneArray['protein_class']); // todo одинаковый сепаратор для всех group_concat
        $geneDto->commentEvolution = $geneArray['comment_evolution'];
        $geneDto->commentFunction = $geneArray['comment_function'];
        $geneDto->commentAging = $geneArray['comment_aging'];
        $geneDto->commentsReferenceLinks = $geneCommentsReferenceLinks;
        $geneDto->rating = $geneArray['rating'];
        $geneDto->functionalClusters = $this->mapFunctionalClusterDtos($geneArray['functional_clusters']);
        $geneDto->expressionChange = $this->prepareExpressionChangeForView($geneArray['expressionChange'], $lang);
        $geneDto->why = explode(',', $geneArray['why']);
        $geneDto->band = $geneArray['band'];
        $geneDto->locationStart = $geneArray['locationStart'];
        $geneDto->locationEnd = $geneArray['locationEnd'];
        $geneDto->orientation = $geneArray['orientation'];
        $geneDto->accPromoter = $geneArray['accPromoter'];
        $geneDto->accOrf = $geneArray['accOrf'];
        $geneDto->accCds = $geneArray['accCds'];
        $geneDto->orthologs = $this->prepareOrthologs($geneArray['orthologs']);

        return $geneDto;
    }

    public function mapLatestViewDto(array $geneArray): LatestGeneViewDto
    {
        $geneDto = new LatestGeneViewDto();
        $geneDto->id = (int)$geneArray['id'];
        $geneDto->origin = $this->prepareOrigin($geneArray);
        $geneDto->symbol = $geneArray['symbol'];
        return $geneDto;
    }

    public function mapListViewDto(array $geneArray, string $lang): GeneListViewDto
    {
        $geneDto = new GeneListViewDto();
        $geneDto->id = (int)$geneArray['id'];
        $geneDto->name = $geneArray['name'];
        $geneDto->origin = $this->prepareOrigin($geneArray);
        $geneDto->symbol = $geneArray['symbol'];
        $geneDto->entrezGene = $geneArray['entrezGene'];
        $geneDto->uniprot = $geneArray['uniprot'];
        $geneDto->expressionChange = $this->prepareExpressionChangeForView($geneArray['expressionChange'], $lang);
        $geneDto->aliases = explode(' ', $geneArray['aliases']);
        $geneDto->functionalClusters = $this->mapFunctionalClusterDtos($geneArray['functional_clusters']);
        return $geneDto;
    }

    /**
     * @param string $geneFunctionalClustersString
     * @return FunctionalClusterDto[]
     */
    private function mapFunctionalClusterDtos($geneFunctionalClustersString): array
    {
        $functionalClusterDtos = [];
        if ($geneFunctionalClustersString) {
            $functionalClustersArray = explode(',', $geneFunctionalClustersString);
            foreach ($functionalClustersArray as $functionalCluster) {
                list($id, $name) = explode('|', $functionalCluster);
                $functionalClusterDto = new FunctionalClusterDto();
                $functionalClusterDto->id = (int)$id;
                $functionalClusterDto->name = $name;
                $functionalClusterDtos[] = $functionalClusterDto;
            }
        }

        return $functionalClusterDtos;
    }

    private function prepareOrthologs($orthologsString): array
    {
        $result = [];
        $orthologs = explode(';', $orthologsString);
        foreach ($orthologs as $orthologString) {
            if(strpos($orthologString, ',')) {
                list($organism, $ortholog) = explode(',', $orthologString);
                $result[$organism] = $ortholog;
            } else {
                $result[$orthologString] = '';
            }
        }
        return $result;
    }

    private function prepareOrigin($geneArray)
    {
        $phylum = new PhylumDto();
        $phylum->id = (int)$geneArray['phylum_id'];
        $phylum->age = $geneArray['phylum_age'];
        $phylum->phylum = $geneArray['phylum_name'];
        $phylum->order = (int)$geneArray['phylum_order'];
        return $phylum;
    }

    private function prepareExpressionChangeForView($expressionChange, string $lang): ?string // todo изменить в бд хранение изменения экспрессии
    {
        if(!$expressionChange || !isset(self::$expressionChangeEn[$expressionChange])) {
            $expressionChange = 'не изменяется';
        }
        return $lang == 'en-US' ? self::$expressionChangeEn[$expressionChange] : $expressionChange;
    }

}