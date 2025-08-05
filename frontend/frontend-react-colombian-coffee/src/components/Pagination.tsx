

type PaginationProps = {
    currentPage: number;
    totalPages: number;
    onPageChange: (page: number) => void;
  };
  
  function Pagination({ currentPage, totalPages, onPageChange }: PaginationProps) {
  const handlePageChange = (newPage: number) => {
    if (newPage < 1 || newPage > totalPages) return; 
    onPageChange(newPage);
  };

  return (
    <div className="pagination">
      <button onClick={() => handlePageChange(currentPage - 1)} disabled={currentPage === 1}>
        Anterior
      </button>

      <span>Página {currentPage} de {totalPages}</span>

      <button onClick={() => handlePageChange(currentPage + 1)} disabled={currentPage === totalPages}>
        Siguiente
      </button>
    </div>
  );
}

  
  export default Pagination;
  