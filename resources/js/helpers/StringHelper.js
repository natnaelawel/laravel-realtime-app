class StringHelper
{
    slugify(str){
        var str = str.toLocaleLowerCase().split(" ");
        let slug = "";
        .replaceAll(" ", "-");
        str.forEach(element => {
            slug += element + '-'
        });

    }
}
