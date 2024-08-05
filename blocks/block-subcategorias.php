<?PHP
$parent_term = get_term_by('slug', '{{categoria-padre}}', 'product_cat');
if ($parent_term) {
    print_child_terms($parent_term, 5); // Print up to 5 child terms
}