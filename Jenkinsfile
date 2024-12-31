pipeline {
    agent any

    stages {
        stage('SCM') {
            steps {
                git branch: 'main', changelog: false, poll: false, url: 'https://github.com/ink2m/GSCOMP255.git'
            }
        }
        stage('Docker build and push') {
            steps {
                script {
                    withDockerRegistry(credentialsId:'dockerhub') {
                        bat "docker build -t ink2m/backend:1.0 ."
                        bat "docker push ink2m/backend:1.0"
                    }
                }
            }
        }
    }
}
