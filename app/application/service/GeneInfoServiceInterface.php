<?php
namespace application\service;

use application\dto\GeneFullViewDto;
use application\dto\GeneListViewDto;
use application\dto\LatestGeneViewDto;

interface GeneInfoServiceInterface
{
    /**
     * @param string $geneSymbol
     * @param string $lang
     * @return GeneFullViewDto
     */
    public function getGeneViewInfo(string $geneSymbol, string $lang = 'en-US'): GeneFullViewDto;

    /**
     * @param int $count
     * @param string $lang
     * @return LatestGeneViewDto[]
     */
    public function getLatestGenes(int $count, string $lang = 'en-US'): array;
    /**
     * @param int $count
     * @param string $lang
     * @return GeneListViewDto[]
     */
    public function getAllGenes(int $count = null, string $lang = 'en-US'): array;

    /**
     * @param array $functionalClustersIds
     * @param string $lang
     * @return GeneListViewDto[]
     */
    public function getByFunctionalClustersIds(array $functionalClustersIds, string $lang = 'en-US'): array;

    /**
     * @param int $expressionChange
     * @param string $lang
     * @return GeneListViewDto[]
     */
    public function getByExpressionChange(int $expressionChange, string $lang = 'en-US'): array;
    
    /**
     * @param string $term
     * @param string $lang
     * @return GeneListViewDto[]
     */
    public function getByGoTerm(string $term, string $lang = 'en-US'): array;
}