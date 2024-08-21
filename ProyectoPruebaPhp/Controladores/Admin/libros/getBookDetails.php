<?php
include('../../../Controladores/Admin/libros/libros.php');

if (isset($_GET['id'])) {
    $bookId = intval($_GET['id']);
    $query = "SELECT titulo_libro, contenido FROM libros WHERE id = $bookId";
    $result = $mysqli->query($query);

    if ($result) {
        $book = $result->fetch_assoc();
        echo json_encode([
            'title' => $book['titulo_libro'],
            'content' => $book['contenido']
        ]);
    } else {
        echo json_encode(['error' => 'Book not found']);
    }
} else {
    echo json_encode(['error' => 'No book ID specified']);
}
?>
