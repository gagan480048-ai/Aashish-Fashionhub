
<?php



include("includes/header.php");
?>

<h2>Products</h2>

<div class="row">

<?php
$products = [
    1 => ["name" => "Nike Shoes", "price" => 2000,"image"=>"https://cdn.pixabay.com/photo/2016/12/16/14/44/shoes-1911527_1280.jpg"],
    2 => ["name" => "Adidas Shoes", "price" => 2500,"image"=>"https://cdn.pixabay.com/photo/2022/05/05/11/15/trainers-7175887_1280.png"],
    3 => ["name" => "BLUE Shoes", "price" => 2000,"image"=>"https://media.istockphoto.com/id/1491624336/de/foto/nahaufnahme.jpg?s=2048x2048&w=is&k=20&c=7qSeSmGeEysbidT5bwM7A14DFLJ0krIVyKkXH9cgUvQ="],
    4 => ["name" => "REDTAP Shoes", "price" => 25000,"image"=>"https://media.istockphoto.com/id/1410926705/photo/3d-illustration.jpg?s=612x612&w=0&k=20&c=Fg_vnaRa4_W_E_DPVdTq3wra-Hk7tDpiKE02EmIcTaE="],
    5 => ["name" => " redchief shoes", "price" => 2000,"image"=>"https://cdn.pixabay.com/photo/2023/05/03/22/43/tennis-7968714_960_720.png"],
    6 => ["name" => "Adi Shoes", "price" => 1200,"image"=>"https://media.istockphoto.com/id/1407127841/de/foto/wei%C3%9Fer-sneaker-mit-farbigen-akzenten-auf-gr%C3%BCnem-verlaufshintergrund-herrenmode-sportschuh-air.jpg?s=2048x2048&w=is&k=20&c=QH9P7Q6D1HWY42w7fvKcuybQggRimJyygMtT_QF_SpY="],
   7 => ["name" => "feet Shoes", "price" => 1000,"image"=>"https://media.istockphoto.com/id/1434613895/de/foto/3d-abbildung.jpg?s=1024x1024&w=is&k=20&c=IpsJdV_0_eEvJwXxn2i0C-ZN4Rmhav_LZOrMf9dJbA4="],
    8 => ["name" => "das Shoes", "price" => 900,"image"=>"https://media.istockphoto.com/id/1414604625/de/foto/3d-illustration.jpg?s=2048x2048&w=is&k=20&c=SlOvpKUDiOWLOGUjRRV0F9x2u0ofO4a72_3LEXhMkKs="],
    
];
foreach ($products as $id => $product) {
?>
    <div class="col-md-4">
        <div class="card p-3 mb-3">
                <div class="card-header">
                    <img src="<?php echo $product["image"] ?>" alt="" class="img-fluid">
                </div>
            <h5><?php echo $product['name']; ?></h5>
            <p>₹<?php echo $product['price']; ?></p>
            <a href="cart.php?id=<?php echo $id; ?>" class="btn btn-primary">Add to Cart</a>
        </div>
    </div>
<?php } ?>

</div>

<?php include("includes/footer.php"); ?>