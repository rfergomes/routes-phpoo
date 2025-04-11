<?php
namespace app\database;

class Pagination
{
    private int $currentPage = 1;
    private int $totalPages;
    private int $linksPerPage = 5;
    private int $itemsPerPage = 10;
    private int $totalItems;
    private string $pageIdentifier = 'page';

    public function setTotalItems(int $totalItems)
    {
        $this->totalItems = $totalItems;
    }

    public function setPageIdentifier(string $identifier)
    {
        $this->pageIdentifier = $identifier;
    }

    public function setItemsPerPage(int $itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
    }

    public function getTotal()
    {
        return $this->totalItems;
    }

    public function getPerPage()
    {
        return $this->itemsPerPage;
    }

    private function calculations()
    {
        $this->currentPage = $_GET['page'] ?? 1;

        $offset = ($this->currentPage - 1) * $this->itemsPerPage;

        $this->totalPages  = ceil($this->totalItems / $this->itemsPerPage);

        return "LIMIT {$this->itemsPerPage} OFFSET {$offset}";
    }

    public function dump()
    {
        return $this->calculations();
    }

    public function getFootPage(): string
    {
        return "<div class='datatable-info'>Exibindo {$this->itemsPerPage} itens por página do total de {$this->totalItems} itens</div>";
    }

    public function links()
    {
        $links ="<nav class='datatable-pagination' aria-label='Page navigation'>
        <ul class='pagination'>";

        if ($this->currentPage > 1) {
            $previous = $this->currentPage - 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $previous]));
            $first = http_build_query(array_merge($_GET, [$this->pageIdentifier => 1]));
            $links.= "<li class='datatable-pagination-list-item datatable-hidden datatable-disabled'><a href='?{$linkPage}' class='datatable-pagination-list-item-link'>Anterior</a></li>";
            $links.= "<li class='datatable-pagination-list-item datatable-hidden datatable-disabled'><a href='?{$first}' class='datatable-pagination-list-item-link'>Primeira</a></li>";
        }


        // 3 - 5 =     7 + 5 = 12
        for ($i=$this->currentPage - $this->linksPerPage; $i <=$this->currentPage + $this->linksPerPage ; $i++) {
            if ($i > 0 && $i <= $this->totalPages) {
                $class = $this->currentPage === $i ? 'datatable-active' : '';
                $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $i]));
                $links.="<li class='datatable-pagination-list-item {$class}'><a href='?{$linkPage}' class='datatable-pagination-list-item-link'>{$i}</a></li>";
            }
        }


        if ($this->currentPage < $this->totalPages) {
            $next = $this->currentPage + 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $next]));
            $last = http_build_query(array_merge($_GET, [$this->pageIdentifier => $this->totalPages]));
            $links.= "<li class='datatable-pagination-list-item datatable-hidden datatable-disabled'><a href='?{$linkPage}' class='datatable-pagination-list-item-link'>Próxima</a></li>";
            $links.= "<li class='datatable-pagination-list-item datatable-hidden datatable-disabled'><a href='?{$last}' class='datatable-pagination-list-item-link'>Última</a></li>";
        }

        $links.="</ul>
        </nav>";
        return $links;
    }
}
