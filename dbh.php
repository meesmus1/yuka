
<?php
$hostname = 'localhost';
$DBemail = 'root';
$DBpassword = '';
$database = 'radijs';

$conn = mysqli_connect($hostname,$DBemail,$DBpassword,$database);




function generate_uuid_v4() {
    // Generate 16 bytes of random data
    $data = random_bytes(16);

    // Set the version bits (4) and the variant bits (2)
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // version 4
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // variant bits
    // Convert binary to hex
    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    return $uuid;
}
// Example usage
$uuid = generate_uuid_v4();
?>