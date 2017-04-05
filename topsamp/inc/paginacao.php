 <div class="col-md-7 paginacao">
                <nav aria-label="Page navigation" class="right">
                    <!-- PAGINAÇÃO -->
                    <ul class="pagination"> 
                        <?php
                        if ($pagina == 1) {
                            echo "<li class='disabled'><a href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                        } else {
                            $pagAnterior = $pagina - 1;
                            echo "<li><a href='index.php?pagina=$pagAnterior' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                        }
                        for ($i = 1; $i < $numPaginas + 1; $i++) {
                            
                                if ($pagina == $i) {
                                    echo "<li class='active'><a href='index.php?pagina=$i'>" . $i . "</a></li>";
                                } else {
                                    echo " <li class='waves-effect'><a href='index.php?pagina=$i'>" . $i . "</a></li> ";
                                }
                            
                        }
                        if ($pagina == $numPaginas) {
                            echo "<li class='disabled'><a href='javascript:void(0)' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
                        } else {
                            $pagAnterior = $pagina + 1;
                            echo "<li><a href='index.php?pagina=$pagAnterior' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>