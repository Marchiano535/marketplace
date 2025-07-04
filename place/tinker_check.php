use App\Models\User;
$users = User::all();
foreach($users as $user) {
    echo $user->email . " - " . $user->name . "\n";
}
echo "Total users: " . $users->count() . "\n";
exit;
