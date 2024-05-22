Because of my wrong bash script, all of my commit names were set as "commit_name"

function gcom() {
    if [ -n "$1" ]; then
        # -n checks if $1 is not empty
        commit_name=$1
    else
        commit_name="changes"
    fi
    echo "commit name: $commit_name"
    git add .
    git commit -m commit_name  ---------> error here. correction => git commit -m "$commit_name"
}