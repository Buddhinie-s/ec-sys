ipeline {
    agent any

    stages {
        stage('SCM') {
            steps {
                git branch: 'main', changelog: false, poll: false, url: 'https://github.com/Buddhinie-s/ec-sys.git'
            }
        }
        stage('Docker build and push') {
            steps {
                script {
                    withDockerRegistry(credentialsId:'JenkinIdBuddhinie') {
                        bat "docker build -t buddhinie/ecsystem:1.0 ."
                        bat "docker push buddhinie/ecsystem:1.0"
                    }
                }
            }
        }
    }
}
