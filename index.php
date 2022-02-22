<?php

/**
 * Reprenez le code de l'exercice précédent et transformez vos requêtes pour utiliser les requêtes préparées
 * la méthode de bind du paramètre et du choix du marqueur de données est à votre convenance.
 */


/**
 * Pour cet exercice, vous allez utiliser la base de données table_test_php créée pendant l'exo 189
 * Vous utiliserez également les deux tables que vous aviez créées au point 2 ( créer des tables avec PHP )
 */

try {
    /**
     * Créez ici votre objet de connection PDO, et utilisez à chaque fois le même objet $pdo ici.
     */
    $pdo = new PDO('mysql:host=localhost;dbname=table_test_php;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /**
     * 1. Insérez un nouvel utilisateur dans la table utilisateur.
     */

    $name = 'Name';
    $firstName = 'FirstName';
    $email = 'email@mail.com';
    $password = 'p@sswoooRd';
    $address = 'Address';
    $zip_code = '00000';
    $country = 'Country';

    $stmt = $pdo->prepare("
        INSERT INTO user (name, first_name, email, password, address, zip_code, country) 
        VALUES (:name, :firstName, :email, :password, :address, :zip_code, :country);
    ");

    $stmt->bindParam('name', $name);
    $stmt->bindParam('firstName', $firstName);
    $stmt->bindParam('email', $email);
    $stmt->bindParam('password', $password);
    $stmt->bindParam('address', $address);
    $stmt->bindParam('zip_code', $zip_code);
    $stmt->bindParam('country', $country);

    $stmt->execute();

    /**
     * 2. Insérez un nouveau produit dans la table produit
     */

    $title = 'Title';
    $price = 7.5;
    $shortDescription = 'the short description';
    $longDescription = 'the loooooooooooooooooooooooooooooong description';

    $stmt2 = $pdo->prepare("
        INSERT INTO product (title, price, short_description, long_description) 
        VALUES (:title, :price, :shortDescription, :longDescription);
    ");

    $stmt2->bindParam('title', $title);
    $stmt2->bindParam('price', $price);
    $stmt2->bindParam('shortDescription', $shortDescription);
    $stmt2->bindParam('longDescription', $longDescription);

    $stmt2->execute();


    /**
     * 3. En une seule requête, ajoutez deux nouveaux utilisateurs à la table utilisateur.
     */

    $stmt = $pdo->prepare("
        INSERT INTO user (name, first_name, email, password, address, zip_code, country) 
        VALUES (?, ?, ?, ?, ?, ?, ?),
               (?, ?, ?, ?, ?, ?, ?);
    ");

    $stmt->execute([
        'name', 'firstName', 'email1', 'password', 'address', 'zipCode', 'country',
        'name', 'firstName', 'email2', 'password', 'address', 'zipCode', 'country'
    ]);

    /**
     * 4. En une seule requête, ajoutez deux produits à la table produit.
     */

    $stmt2 = $pdo->prepare("
        INSERT INTO product (title, price, short_description, long_description) 
        VALUES (?, ?, ?, ?),
               (?, ?, ?, ?);
    ");

    $stmt2->execute([
        'tilte', '5.2', 'shortDescription', 'longDescription',
        'tilte', '8.3', 'shortDescription', 'longDescription'
    ]);

} catch (PDOException $e) {
    echo $e;
}